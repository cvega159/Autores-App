@extends('base')

@section('content')
 @if(auth()->user()->rol=='editor')
          <li>
            <a href="{{url('user')}}">
              <i class="nc-icon nc-bank"></i>
              <p>Gestion de usuarios</p>
            </a>
          </li>
          <li>
            <a href="{{url('libro')}}">
              <i class="nc-icon nc-diamond"></i>
              <p>Libros</p>
            </a>
          </li>
          <li>
             <a href="{{route('user.borrar')}}">
              <i class="nc-icon nc-diamond"></i>
              <p>Borrados</p>
            </a>
          </li>
          <li>
            <a href="{{url('categoria')}}">
              <i class="nc-icon nc-diamond"></i>
              <p>Categoria</p>
            </a>
          </li>
    @endif
@endsection

@section('content2')
<nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
    <div class="container-fluid">
      <div class="navbar-wrapper">
        <div class="navbar-toggle">
          <button type="button" class="navbar-toggler">
            <span class="navbar-toggler-bar bar1"></span>
            <span class="navbar-toggler-bar bar2"></span>
            <span class="navbar-toggler-bar bar3"></span>
          </button>
        </div>
        <a class="navbar-brand" href="javascript:;">Listado de los libros</a>
      </div>
      
    </div>
  </nav>
  
  <div class="content">
       <div class="col-md-10" style="margin:0 auto">
  
            <div class="card card-user">
              <div class="image">
                <img src="../assets/img/damir-bosnjak.jpg" alt="...">
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="#">
                    <img class="avatar border-gray" src="{{url('storage/usuarios/'. auth()->user()->img)}}">
                    <h5 class="title">{{$libro->user->name}}</h5>
                  </a>
                </div>
              </div>
            </div>
    <div class="row">
      
      <div class="col-md-10" style="margin:0 auto">
          <div class="card card-user">
            <div class="card-header">
              <h5 class="card-title">Edit Profile</h5>
            </div>
            <div class="card-body">
              <table class="table table-striped">
                  <tbody>
                    <tr>
                          <td>Imagen</td> 
                              <td><img class="img" src="{{url('storage/libros/'. $libro->imgLibro)}}"></td> 
                          </tr>
                          <tr>
                              <td>Id</td> 
                              <td>{{ $libro->id }}</td> 
                          </tr>
                          <tr>
                              <td>Nombre</td>
                              <td>{{ $libro->nombre }}</td> 
                          </tr>
                          <tr>
                              <td>Paginas</td> 
                              <td>{{ $libro->paginas }}</td> 
                          </tr>
                          <tr>
                              <td>Codigo libro</td> 
                              <td>{{ $libro->codLibro }}</td> 
                          </tr>
                          <tr>
                              <td>Precio</td> 
                              <td>{{ $libro->precio }}</td> 
                          </tr>
                          <tr>
                              <td>Editorial</td> 
                              <td>{{ $libro->editorial }}</td> 
                          </tr>
                          <tr>
                              <td>Autor</td> 
                              <td>{{ $libro->user->name }}</td> 
                          </tr>
                          <tr>
                              <td>Categoria</td> 
                              <td>{{ $libro->categoria->nombreCategoria }}</td> 
                          </tr>
                  </tbody>
              </table>
            </div>
          </div>
        </div>  
    </div>
    
       @if(auth()->user()->rol=='editor')
        <a class="btn btn-primary" href="{{url('libro')}}">Volver</a><br><br>
    @endif
    @if(auth()->user()->rol=='autor')
        <a class="btn btn-primary" href="{{url('libro/'.$libro->user_id)}}">Volver</a><br><br>
    @endif
</div>
  
  @endsection