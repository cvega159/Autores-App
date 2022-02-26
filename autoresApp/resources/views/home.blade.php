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

@if(auth()->user()->rol=='editor')
<div class="content">
   <div class="col-md-10" style="margin:0 auto">

        <div class="card card-user">
          <div class="card-body">
            <div class="author">
              <a href="#">
                <img class="avatar border-gray" src="{{url('storage/usuarios/'. auth()->user()->img)}}">
                <h1>Bienvenido {{auth()->user()->name}}</h1>
              </a>
            </div>
          </div>
        </div>
    </div>
</div>

@endif

@if(auth()->user()->rol=='autor')
<div class="content">
   <div class="col-md-10" style="margin:0 auto">

        <div class="card card-user">
          <div class="card-body">
            <div class="author">
              <a href="#">
                <img class="avatar border-gray" src="{{url('storage/usuarios/'. auth()->user()->img)}}">
                <h1>Bienvenido {{auth()->user()->name}}</h1>
              </a>
            </div>
          </div>
        </div>
    </div>
</div>
@endif


@endsection
