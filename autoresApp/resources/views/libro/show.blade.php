@extends('base')

@section('content')
 @if(auth()->user()->rol=='autor')
  <li>
    <a href="{{url('libro/'. auth()->user()->id)}}">
      <i class="nc-icon nc-diamond"></i>
      <p>Bibliografia</p>
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
  <a style="margin:0;" class="btn btn-primary" href="{{url('libro/create')}}">Dar de alta un libro</a>
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
          @foreach($libro as $lib)
            <tr>
              <td>{{$lib->id}}</td>
              <td>{{$lib->nombre}}</td>
              <td>{{$lib->paginas}}</td>
              <td>{{$lib->codLibro}}</td>
              <td>{{$lib->precio}}</td>
              <td>{{$lib->editorial}}</td>
              <td><img class="img" src="{{url('storage/libros/'. $lib->imgLibro)}}"></td>
              <td><a class="btn btn-warning" href="{{url('libro/'.$lib->id.'/edit')}}">Editar</a></td>
              <td>
                  <form class="fooorm" action="{{ url('libro/'.$lib->id)}}" method="post">
                      <input class="btn btn-danger" type="submit"  value="Borrar"/>
                      @method('delete')
                      @csrf
                 </form>    
              </td>
              <td><a class="btn btn-info" href="{{url('showLibro/'.$lib->id)}}">Ver librito</a></td>
            </tr>  
          @endforeach
          
      </tbody>
    </table>
    
    <a class="btn btn-primary" href="{{url('home')}}">Volver</a><br><br>
    </div>
</div>
  
  
  @endsection