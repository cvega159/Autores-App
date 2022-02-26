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
        <a class="navbar-brand" href="javascript:;">Libros del autor {{$user->name}}</a>
      </div>
</nav>
<div class="content">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">nombre</th>
          <th scope="col">paginas</th>
          <th scope="col">codigo libro</th>
          <th scope="col">precio</th>
          <th scope="col">editorial</th>
          <th scope="col">img</th>      
          <th scope="col">Editar</th>
          <th scope="col">Borrar</th>
          <th scope="col">Ver libro</th>
        </tr>
      </thead>
      
      
      <tbody>
          @foreach($user->libros as $libro)
            <tr>
              <td>{{$libro->id}}</td>
              <td>{{$libro->nombre}}</td>
              <td>{{$libro->paginas}}</td>
              <td>{{$libro->codLibro}}</td>
              <td>{{$libro->precio}}</td>
              <td>{{$libro->editorial}}</td>
              <td><img class="img" src="{{url('storage/libros/'. $libro->imgLibro)}}"></td>
              <td><a class="btn btn-warning" href="{{url('libro/'.$libro->id.'/edit')}}">Editar</a></td>
              <td>
                  <form class="fooorm" action="{{ url('libro/'.$libro->id)}}" method="post">
                      <input class="btn btn-danger" type="submit"  value="Borrar"/>
                      @method('delete')
                      @csrf
                 </form>    
              </td>
              <td><a class="btn btn-info" href="{{url('showLibro/'.$libro->id)}}">Ver libro</a></td>
            </tr>  
          @endforeach
          
      </tbody>
    </table>
    
    <a class="btn btn-primary" href="{{url('user')}}">Volver</a><br><br>
    </div>
</div>
  
  
  @endsection