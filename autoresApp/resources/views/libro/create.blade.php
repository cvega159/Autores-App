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
        <a class="navbar-brand" href="javascript:;">Añade un libro</a>
      </div>
      
    </div>
  </nav>
  
<div class="content">
    <div class="col-md-10" style="margin:0 auto">
    <form method="POST" id="fuseredit" action="{{route('libro.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <label for="nombre" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>
    
            <div class="col-md-6">
                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>
    
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
                <input id="paginas" type="number" class="form-control @error('paginas') is-invalid @enderror" name="paginas" value="{{ old('paginas')}}" required autocomplete="paginas">
    
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
                <input id="codLibro" type="number" class="form-control @error('codLibro') is-invalid @enderror" name="codLibro" value="{{ old('codLibro')}}" required autocomplete="codLibro">
    
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
                <input id="precio" type="number" class="form-control @error('precio') is-invalid @enderror" name="precio" value="{{ old('precio')}}" required autocomplete="precio">
    
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
                  <div class="input__item">
                   <select id="editorial" class="form-control" name="editorial" type="text" placeholder="">
                         <option value=""  @if(old('editorial') == '') selected  @endif disabled >&nbsp;</option>
                            @foreach($editorial as $editorial)
                                <option value="{{ $editorial }}" @if(old('editorial') == $editorial)  selected @endif >{{ $editorial }}</option>

                            @endforeach
                    </select>
                </div>
            </div>
        </div>
        
        <div class="row mb-3">
            <label for="precio" class="col-md-4 col-form-label text-md-end">{{ __('User id') }}</label>
    
            <div class="col-md-6">
                <div class="input__item">
                    @if(auth()->user()->rol=='autor')
                    <select id="user_id" class="form-control" name="user_id" type="text" placeholder="">
                         <option value=""  @if(old('user_id') == '') selected  @endif disabled >&nbsp;</option>
                            <option value="{{ auth()->user()->id}}" selected>{{ auth()->user()->name }}</option>
                    </select>
                    @else
                    <select id="user_id" class="form-control" name="user_id" type="text" placeholder="">
                         <option value=""  @if(old('user_id') == '') selected  @endif disabled >&nbsp;</option>
                            @foreach($users as $user_id)
                                @if(auth()->user()->id != $user_id->id)
                                    <option value="{{ $user_id->id }}" selected>{{ $user_id->name }}</option>
                                @endif
                            @endforeach
                            
                    </select>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="row mb-3">
            <label for="precio" class="col-md-4 col-form-label text-md-end">{{ __('Categoria') }}</label>
    
            <div class="col-md-6">
                <div class="input__item">
                   <select id="categoria_id" class="form-control" name="categoria_id" type="text" placeholder="">
                         <option value=""  @if(old('user_id') == '') selected  @endif disabled >&nbsp;</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" selected>{{ $categoria->nombreCategoria }}</option>
                            @endforeach
                    </select>
                </div>
            </div>
        </div>
        
         <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                 <input id="archivo"  type="file" accept="image/png , image/jpeg" enctype="multipart/form-data" name="archivo"/>
            </div>
        </div>
       
        <div class="row mb-3">
            <div class="col-md-6">
               <button type="submit" id="userupdatebuton" class="btn btn-primary">Crear</button>
            </div>
        </div>
    </form>

    @if(auth()->user()->rol=='editor')
        <a class="btn btn-primary" href="{{url('libro')}}">Volver</a><br><br>
    @endif
    @if(auth()->user()->rol=='autor')
        <a class="btn btn-primary" href="{{url('libro/'.auth()->user()->id)}}">Volver</a><br><br>
    @endif
    
    
    </div>    
</div>

@endsection