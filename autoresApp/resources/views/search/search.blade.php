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
        <a class="navbar-brand" href="javascript:;">Busqueda de los autores</a>
      </div>
      
    </div>
  </nav>
  
<div class="content">
  <div class="col-md-10" style="margin:0 auto">
    @if($libros->isNotEmpty() )   
        @foreach ($libros as $libro)
            <div class="card">
                <div class="card-header">
                     <strong class="card-title mb-3">{{$libro->nombre}}</strong>
                </div>
                <div class="card-body">
                    <div class="mx-auto d-block">
                        
                        
                    </div>
                    
                </div>
            </div>
        @endforeach
        @endif
  </div>
</div>
@endsection