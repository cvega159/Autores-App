<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Libro;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserCreateRequest;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller{
   
   public function __construct(){
       $this->middleware('verified')->only('userupdate');
       $this->middleware('editor')->except('userupdate');
      
   }
   
   
    public function index(){
        //paginacion
        //dd(auth()->user()->libros()->id);
        //ordenacion
        $data = [];
        //filtrado de datos
        $data['users'] = User::all();
        //registros por pagina
        
        return view('user.index',['users' => User::paginate(5)],$data);
    }
    
    
    public function borrar(){
        $data = [];
        //filtrado de datos
        
        $data['users'] = User::onlyTrashed()->get();
        //registros por pagina
        return view('user.borrar',$data);
    }
    
    public function restaurar(int $id){
        User::onlyTrashed()->find($id)->restore();
        return back();
    }
    
    public function borrarDefinitivo(int $id){
        User::onlyTrashed()->find($id)->forceDelete();
        return back();
    }
    
    public function create(){
        // return view('user.create',['roles'=>['editor','autor']]);
        return view('auth.register',['roles'=>['editor','autor']]);
    }

   
    public function store(UserCreateRequest $request){
        try{
            $user=new User($request->all());
            // dd($request->input('password'));
            $user->password=Hash::make($request->password);
            if($request->verificacion=='on'){
                $user->email_verified_at==Carbon::now();
            }else{
                //
            }
            if($request->validated=='on'){
                $user->validated=true;
            }
            $user->save();
            $archivo=$request->archivo;
            
            $nombre = $archivo->getClientOriginalName();
            $data=[];//creas un array donde metes los datos
            $data['nombreArchivo']= $this->createId().'.'.$archivo->getClientOriginalExtension();//crear nombre unico para la imagen
            
            DB::update('update users set img = :nombreArchivo where id = :id', ['nombreArchivo' => $data['nombreArchivo'],'id' => $user->id]);
            //dd($libro);
            $archivo->storeAs('public/users/', $data['nombreArchivo']);//lo metes en el storage
            return redirect('user');
        }catch(\Exception $e){
            dd($e);
            return back()->withInput();
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
    
    public function show(User $user){
        //dd($user);
        //$user = User::find($id);
        //$libros = Libro::where('user_id', $user->id)->get();
        //$libros2 = DB::table('libros')->select('*')->where('user_id', '=', $user->id)->get();
        //return view('user.show',['user' => $user, 'libros' => $libros2, 'libros2' => $libros2]);
        return view('user.show',['user'=>$user]);
    }

   
    public function edit($id){
        $user = User::find($id);
        return view('user.edit',['roles'=>['editor','autor'],'user'=>$user]);
    }

    public function userupdate(Request $request){
        
        if($request->password !=null && $request->oldpassword !=null){
            //Cambiar clave
            $r= Hash::check($request->oldpassword, auth()->user()->password);
            if($r){
                $result = $this->userSave($request,true);
            }else{
                //Error
                return back()->withInput()->withErrors(['oldpassword' => 'La clave de acceso anterior no es correcta.']);
            }
        }elseif($request->password ==null && $request->oldpassword ==null){
            $result = $this->userSave($request,false);
        }else{
            //Error
            return back()->withInput()->withErrors(['generic' => 'Se han de introducir las claves de acceso o no.']);
        }
        if($result){
            $data =['message'=>'todo bien'];
        }else{
            $data =['message'=>'todo mal'];
        }
        return redirect(url('/home'))->with($data);
    }
    
    
    public function userSave(Request $request, $isNewPassword){
        $result=true;
        $user = auth()->user();
        $user->name = $request->input('name'); //$request->name
        if($user->email != $request->input('email')){
            $user->email = $request->input('email');
            //Anular la fecha de verificacion
            //Enviar un correo electronico
            $user->email_verified_at =null;
        }
        
        if($isNewPassword){
             $user->password = Hash::make($request->input('password'));
        }
        try{
            $user->save();
            $user->sendEmailVerificationNotification();
        }catch(\Exception $e){
            $result = false;
        }
        return $result;
    }
    
    public function update(UserEditRequest $request, User $user){
     
        if($request->password==null){
            $data=$request->except(['password']);
        }else{
            $data=$request->all();
            $data['password']=Hash::make($request->input('password'));
        }
        $data=$request->all();
        try{
            $user->update($data);
            //$this->updateImg($user,$request->archivo);
        }catch(\Exception $e){
            return back()->withInput();
        }
        return redirect('user');
    }

    private function updateImg( $user, $archivo ){
        
       
        $input = 'archivo';
        if( Storage::exists('/public/usuarios/' . $user->img)){
           Storage::delete('/public/usuarios/' . $user->img);
        }
        
        if(!isset($archivo)){
          
            return back()->withInput();
        }
        try{
            
            //$archivo=$request->archivo;
          
            $data=[];//creas un array donde metes los datos
            $data['nombreArchivo']= $this->createId().'.'.$archivo;//crear nombre unico para la imagen
             DB::update('update users set img = :nombreArchivo where id = :id', ['nombreArchivo' => $data['nombreArchivo'],'id' => $user->id]);
          //  dd($data['nombreArchivo']);
            //$archivo->storeAs('public/usuarios/'. $data['nombreArchivo']);//lo metes en el storage
            Storage::put('public/usuarios/', $data['nombreArchivo']);
        
        }
        catch(\Exception $e){
            //dd($e);
           return back()->with($data);
        }
    }
    
    public function destroy(User $user){
        //dd($user);
        $user->delete();
        return back();
    }
}
