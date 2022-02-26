<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\CategoriaCreateRequest;
use App\Http\Requests\CategoriaEditRequest;
use DB;
class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $data['users'] = User::all(); 
         $data['categorias'] = Categoria::all();
        return view('categoria.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('categoria.create',['roles'=>['editor','autor']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriaCreateRequest $request)
    {
        $categoria=new Categoria($request->all());
        //dd($libro);
        try {
            //dd($request->all());
            $categoria->save();
        } catch(\Exception $e) {
            $result = false;
        }
        return redirect('categoria');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categorium)
    {
        return view('categoria.edit',['categoria'=>$categorium]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriaEditRequest $request,  $id)
    {
        //
        $categoria= Categoria::find($id);
       $data['nombreCategoria']= $request->nombreCategoria;
       //$data['libro_id']=null;
       //dd($id);
        try{
      
            $categoria->update( $data);
            $categoria->save();
        }catch(\Exception $e){
            
        }
        return redirect('categoria');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria= Categoria::find($id);
        try{
            DB::update('update libros set categoria_id = null where categoria_id = :id ',['id' => $id]);
            $categoria->delete();
           
        }catch(\Exception $e){
            dd($e);
        }
       
        return back();
    }
}
