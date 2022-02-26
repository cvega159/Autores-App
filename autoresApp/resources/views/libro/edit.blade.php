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
        <a class="navbar-brand" href="javascript:;">Edita un libro</a>
      </div>
      
    </div>
  </nav>
  
<div class="content">
    <div class="col-md-10" style="margin:0 auto">
    <form method="POST" id="fuseredit" action="{{url('libro/'.$libro->id)}}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row mb-3">
            <label for="nombre" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>
    
            <div class="col-md-6">
                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre', $libro->nombre) }}" required autocomplete="nombre" autofocus>
    
                @error('nombre')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    
        <div class="row mb-3">
            <label for="paginas" class="col-md-4 col-form-label text-md-end">{{ __('Paginas') }}</label>
    
            <div class="col-md-6">
                <input id="paginas" type="paginas" class="form-control @error('paginas') is-invalid @enderror" name="paginas" value="{{ old('paginas', $libro->paginas)}}" required autocomplete="paginas">
    
                @error('paginas')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        
        <div class="row mb-3">
            <label for="codLibro" class="col-md-4 col-form-label text-md-end">{{ __('Codigo libro') }}</label>
    
            <div class="col-md-6">
                <input id="codLibro" type="codLibro" class="form-control @error('codLibro') is-invalid @enderror" name="codLibro" value="{{ old('codLibro', $libro->codLibro)}}" required autocomplete="codLibro">
    
                @error('codLibro')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>        

        <div class="row mb-3">
            <label for="precio" class="col-md-4 col-form-label text-md-end">{{ __('Precio') }}</label>
    
            <div class="col-md-6">
                <input id="precio" type="precio" class="form-control @error('precio') is-invalid @enderror" name="precio" value="{{ old('precio', $libro->precio)}}" required autocomplete="precio">
    
                @error('precio')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div> 
        
        <div class="row mb-3">
            <label for="editorial" class="col-md-4 col-form-label text-md-end">{{ __('Editorial') }}</label>
    
            <div class="col-md-6">
                <input id="editorial" type="editorial" class="form-control @error('editorial') is-invalid @enderror" name="editorial" value="{{ old('editorial', $libro->editorial)}}" required autocomplete="editorial">
    
                @error('editorial')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div> 
        <div class="row mb-3">
            <label for="user" class="col-md-4 col-form-label text-md-end">{{ __('nombre autor') }}</label>
    
            <div class="col-md-6">
                <input id="user" type="user" class="form-control @error('codLibro') is-invalid @enderror" name="user" value="{{ old('user->name', $libro->user->name)}}" required autocomplete="categoria">
    
                @error('user->name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div> 
        
        <div class="row mb-3">
            <label for="categoria" class="col-md-4 col-form-label text-md-end">{{ __('Categoria') }}</label>
    
            <div class="col-md-6">
                <input id="categoria" type="categoria" class="form-control @error('codLibro') is-invalid @enderror" name="categoria" value="{{ old('categoria->nombreCategoria', $libro->categoria->nombreCategoria)}}" required autocomplete="user">
    
                @error('categoria->nombreCategoria')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div> 
    
        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <img class="img" src="{{url('storage/libros/'. $libro->imgLibro)}}">
                 <input style="color:red;" id="archivo"  type="file" accept="image/png , image/jpeg" enctype="multipart/form-data" name="archivo" />
            </div>
        </div>
        
        <div class="row mb-3">
            
            <div class="col-md-6">
               <button type="submit" id="userupdatebuton" class="btn btn-primary">
                   Editar
               </button>
            </div>
        </div>
    </form>
    @if(auth()->user()->rol=='editor')
        <a class="btn btn-primary" href="{{url('libro')}}">Volver</a><br><br>
    @endif
    @if(auth()->user()->rol=='autor')
        <a class="btn btn-primary" href="{{url('libro/'.$libro->user_id)}}">Volver</a><br><br>
    @endif
    </div>    
</div>

@endsection