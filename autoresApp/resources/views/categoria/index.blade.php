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

@if(Session::has('message'))
    <div class="alert alert-{{ session()->get('type') }}" role="alert">
        {{ session()->get('message') }}
    </div>
@endif
<!-- Modal -->
<div class="modal" id="modalDelete" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">¿Estas seguro de que quieres borrar?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>¿Seguro que quieres borrar <span class="name" >XXX</span>?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form id="form" action="" method="post">
            @method('delete')
            @csrf
            <input type="submit" class="btn btn-primary" value="Borrar libro"/>
        </form>
      </div>
    </div>
  </div>
</div>

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
        <a class="navbar-brand" href="javascript:;">Listado de los autores</a>
      </div>
      
    </div>
  </nav>
  
<div class="content">
  <div class="col-md-10" style="margin:0 auto">
    <a class="btn btn-primary" href="{{url('categoria/create')}}">Añadir una categoria</a><br><br>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">nombre categoria</th>
          <th scope="col">Editar</th>
          <th scope="col">Borrar categoria</th>
        </tr>
      </thead>
      <tbody>
        @foreach($categorias as $categoria)
            <tr>
              <td>{{$categoria->id}}</td>
              <td>{{$categoria->nombreCategoria}}</td>
              <td><a class="btn btn-warning" href="{{url('categoria/'.$categoria->id.'/edit')}}">Editar</a></td>
              <td>
                  <a class="btn btn-danger" href="" data-toggle="modal" data-target="#modalDelete" 
                    onclick="deleteElement({{ $categoria->id }}, '{{ $categoria->nombreCategoria }}','categoria')">Borrar</a>  
              </td>
              
            </tr>
        @endforeach
      </tbody>
    </table>
    <a class="btn btn-primary" href="{{url('home')}}">Volver</a><br><br>
  </div>
</div>
@endsection

@section('js')
<script src="{{ url('assets/js/deleteElement.js') }}"></script>
@endsection