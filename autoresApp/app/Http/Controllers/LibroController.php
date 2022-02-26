<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LibroEditRequest;
use App\Http\Requests\LibroCreateRequest;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function getAllAttributes($model) {
        $columns = $model->getFillable();
        $attributes = $model->getAttributes();
        $add = array_merge(array_flip($columns), $attributes);
        $add['id'] = 0;
        return $add;
    }

    private function getRecordsPerPageArray($array) {
        $result = [];
        $rpps = $this->getRpps();
        foreach($rpps as $rpp => $value) {
            $result['rpps'][] = array_merge($array, ['rpp' =>  $rpp]);
        }
        return $result;
    }

    private function getOrderArrays($array) {
        $data = [];
        $orders = ['asc', 'desc'];
        $sorts = $this->getAllAttributes(new Libro());//crear un segundo array donde meto todas las columnas //OTRA FORMA DE ESCRIBIRLA -> ['id','name','artist','budget','category']
        foreach($orders as $order){
            foreach($sorts as $sortindex => $sort){
                $data['order' . $sortindex . $order] = array_merge(['sort' => $sortindex, 'order' => $order], $array);//$array = le pasamos el search si es necesario
            }
        }
        return $data;
    }

    private function getRpps() {
        return [2 => 1, 5 => 1, 10 => 1, 20 => 1];
    }

    private function verifyOrder($order) {
        if($order == null) {
            return $order;
        } elseif($order == 'desc'){
            return $order;
        }
        return 'asc';
    }

    private function verifyRpp($rpp) {
        $rpps = $this->getRpps();
        if(isset($rpps[$rpp])) {
            return $rpp;
        }
        return 2;
    }

    private function verifySort($sort) {
        /*$sorts = ['id' => 1, 'name' => 1, 'category' => 1, 'artist' => 1, 'budget' => 1];*/
        $sorts = $this->getAllAttributes(new Libro());
        if(isset($sorts[$sort])) {
            return $sort;
        }
        return null;
    }
     
    public function index(Request $request)
    {
        //dd($request);
        $data = [];
        $appendData = [];
        $filterData = [];
        $rppData = [];
        $sortData = [];
        $searchData = [];

        $page = $request->input('page');
        $search = $request->input('search');
        $filter = $request->input('filter');
        $sort = $this->verifySort($request->input('sort'));
        $order = $this->verifyOrder($request->input('order'));
        $rpp = $this->verifyRpp($request->input('rpp'));

        if($sort != null && $order != null) {
            $sortData = ['sort' => $sort, 'order' => $order];
        }

        if($rpp != 10) {
            $rppData['rpp'] = $rpp;
        }

        if($search != null){
            $searchData['search']=$search;
            $data['search']=$search;
        }
        
        $appendData = array_merge($appendData, $rppData);
        $appendData = array_merge($appendData, $sortData);
        $appendData = array_merge($appendData, $searchData);

        $data = array_merge($data, $this->getOrderArrays($rppData));//le pasamos los registros por pagina //OTRA FORMA -> (array_merge($rppData,$searchData))
        $data = array_merge($data, $this->getRecordsPerPageArray($appendData));
        $data['rpp'] = $rpp;

        
        $libro = new Libro();
        if($search !== null) {
            //preguntamos por todos los campos (para añadirlos a la busqueda)
            $libro = $libro ->where('id', 'like', '%' . $search . '%')
                                    ->orWhere('nombre', 'like', '%' . $search . '%')
                                    ->orWhere('paginas', 'like', '%' . $search . '%');
        }
        
        if($sort != null && $order != null) {
            $libro = $libro->orderBy($sort, $order);
        }
        
        $data['appendData']=$appendData;
        //dd([$appendData, $data]);
        $libro = $libro->orderBy('nombre', 'asc')->paginate($rpp)->appends($appendData);
    
        $data['libros'] = $libro; //Performance::paginate(10);
        return view('libro.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['libros'] = Libro::all();
        $data['users'] = User::all();
        $data['categorias'] = Categoria::all();
        return view('libro.create',['editorial'=>['penguin ramdon house','planeta','RBA libros','ediciones urbano','edelvives','anaya']],$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LibroCreateRequest $request)
    {
        $libro=new Libro($request->all());
        //dd($libro);
        try {
            //dd($request->all());
            $libro->save();
            //dd($request->archivo);
            $archivo=$request->archivo;
            
            $nombre = $archivo->getClientOriginalName();
            $data=[];//creas un array donde metes los datos
            $data['nombreArchivo']= $this->createId().'.'.$archivo->getClientOriginalExtension();//crear nombre unico para la imagen
            
            DB::update('update libros set imgLibro = :nombreArchivo where id = :id', ['nombreArchivo' => $data['nombreArchivo'],'id' => $libro->id]);
            //dd($libro);
            $archivo->storeAs('public/libros/', $data['nombreArchivo']);//lo metes en el storage
            
        } catch(\Exception $e) {
            $result = false;
        }
        
        if(auth()->user()->rol=='editor'){
            return redirect('libro');
        }else if(auth()->user()->rol=='autor'){
            //dd($libro->id);
            return redirect('libro/'. auth()->user()->id);
        }
        
    }
    
    public function createId(){//crear id aleatorio
        $x = 0;
        $y = 5;
        $Strings = '0123456789abcdefghijklmnopqrstuvwxyz';
        $random =substr(str_shuffle($Strings), $x, $y);
        $id = uniqid($random,true);
        return $id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, $id)
    {
        //$data['users'] = User::all();
        //dd($data['users']);
        
        $libro=DB::table('libros')->where('user_id',$id)->get();
        return view('libro.show',['libro'=>$libro],['user'=>$user]);
    }
    /*
    public function showLibro($id)
    {
        $data['users'] = User::all();
         //$libro=new Libro($request->all());
        $libro=DB::table('libros')->where('user_id',$id)->get();
        dd($libro);
        //return view('libro.show-libro',['libro'=>$libro],$data);
        return view('libro.show-libro',['libro'=>$libro],$data);
    }*/

    public function showLibro(Libro $libro, $id)
    {
        $libro = Libro::find($id);
        //dd($libro);
        $data['users'] = User::all();
        return view('libro.show-libro',['libro'=>$libro],$data);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function edit(Libro $libro)
    {
        return view('libro.edit',['libro'=>$libro]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function update(LibroEditRequest $request, Libro $libro)
    {
        
        $data=$request->all();
        try{
            $libro->update($data);
            $this->updateImg($libro,$request->archivo);
        }catch(\Exception $e){
            //dd($e);
        }
        return redirect('libro');
    }
    
    private function updateImg( $libro, $archivo ){
        $input = 'archivo';
        if( Storage::exists('/public/libros/' . $libro->imgLibro)){
           Storage::delete('/public/libros/' . $libro->imgLibro);
        }
        try{
            $nombre = $archivo->getClientOriginalName();
            $data=[];
            $data['nombreArchivo']= $this->createId().'.'.$archivo->getClientOriginalExtension();
            DB::update('update libros set imgLibro = :nombreArchivo where id = :id', ['nombreArchivo' => $data['nombreArchivo'],'id' => $libro->id]);
            $archivo->storeAs('public/libros/', $data['nombreArchivo']);//lo metes en el storage
        }
        catch(\Exception $e){
            //dd($e);
           return back()->with($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Libro $libro)
    {
        //dd($libro);
        $libro->delete();
        return back();
    }
}
