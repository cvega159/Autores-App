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
        <a class="navbar-brand" href="javascript:;">Listado de los autores borrados</a>
      </div>
      
    </div>
  </nav>
  
<div class="content">
  <div class="col-md-10" style="margin:0 auto">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Numero</th>
          <th scope="col">#id</th>
          <th scope="col">Nombre</th>
          <th scope="col">Email</th>
          <th scope="col">Verificacion</th>
          <th scope="col">Rol</th>
          <th scope="col">Recuperar</th>
          <th scope="col">Borrar</th>
        </tr>
      </thead>
      <tbody>
          @foreach($users as $user)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$user->id}}</td>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td>{{$user->email_verified_at}}</td>
              <td>{{$user->rol}}</td>
              <td><a class="btn btn-warning" href="{{url('restaurar/'.$user->id)}}">Recuperar</a></td>
              <td>
                @if(auth()->user()->id != $user->id)
                  <form class="fooorm" action="{{ url('/borrarDefinitivo/'.$user->id)}}" method="post">
                      <input class="btn btn-danger" type="submit"  value="Borrar"/>
                      @method('delete')
                      @csrf
                  </form>
                @endif
              </td>
            </tr>  
          @endforeach
        
      </tbody>
    </table>

    <a class="btn btn-primary" href="{{url('home')}}">Volver</a><br><br>
  </div>
</div>
@endsection