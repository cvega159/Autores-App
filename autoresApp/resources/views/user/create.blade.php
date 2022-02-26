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
        <a class="navbar-brand" href="javascript:;">Añade un autor</a>
      </div>
      
    </div>
  </nav>
  
<div class="content">
    <div class="col-md-10" style="margin:0 auto">
    <form method="POST" id="fuseredit" action="{{route('register')}}" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
    
            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    
        <div class="row mb-3">
            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }}</label>
    
            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email')}}" required autocomplete="email">
    
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        
        <div class="row mb-3">
            <label for="Password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>
    
            <div class="col-md-6">
                <input id="Password" type="Password" minlenght="8" class="form-control @error('Password') is-invalid @enderror" name="password" value="{{ old('Password')}}" required autocomplete="new Password">
    
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        
        <div class="row mb-3">
            <label for="Password" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar contraseña') }}</label>
            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>
        
        
        <div class="row mb-3">
            <label for="email" class="col-md-4 col-form-label text-md-end">Role</label>
    
            <div class="col-md-6">
                <select id="rol"class="form-control" name="rol" required>
                        <option value="" @if(old('rol')=='') selected @endif disabled>&nbsp;</option>
                        @foreach($roles as $rol)
                            <option value="{{$rol}}" @if(old('rol')==$rol) selected @endif>{{$rol}}</option>
                        @endforeach
                    </select>
    
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        
        <div class="col-md-10 pr-1">
            <h3>Añade una foto</h3>  
             <input id="archivo"  type="file" accept="image/png , image/jpeg" enctype="multipart/form-data" name="archivo"/>
        </div>
        
        
        <div class="row mb-3">
            <label for="Verified" class="col-md-4 col-form-label text-md-end">Verified</label>
    
            <div class="col-md-6">
                <input id="Verified" type="checkbox" class="form-control" name="verified" value="true" @if(old('verified') != "") checked @endif>
            </div>
        </div>
       
        <div class="row mb-3">
    
            <div class="col-md-6">
               <button type="submit" id="userupdatebuton" class="btn btn-primary">
                   Crear
               </button>
            </div>
        </div>
    </form>
    <a class="btn btn-primary" href="{{url('user')}}">Volver</a><br><br>
    </div>    
</div>

@endsection