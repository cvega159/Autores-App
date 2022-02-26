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
        <a class="navbar-brand" href="javascript:;">Añade una categoria</a>
      </div>
      
    </div>
  </nav>
  
<div class="content">
    <div class="col-md-10" style="margin:0 auto">
    <form method="POST" id="fuseredit" action="{{route('categoria.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <label for="nombreCategoria" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>
    
            <div class="col-md-6">
                <input id="nombreCategoria" type="text" class="form-control @error('nombreCategoria') is-invalid @enderror" name="nombreCategoria" value="{{ old('nombreCategoria') }}" required autocomplete="nombreCategoria" autofocus>
    
                @error('nombreCategoria')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
       
        <div class="row mb-3">
            <div class="col-md-6">
               <button type="submit" id="userupdatebuton" class="btn btn-primary">Crear</button>
            </div>
        </div>
    </form>
    <a class="btn btn-primary" href="{{url('categoria')}}">Volver</a><br><br>
    </div>    
</div>

@endsection