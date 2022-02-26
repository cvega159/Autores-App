@extends('base')

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
        <a class="navbar-brand" href="javascript:;">Registrate!</a>
      </div>
    </div>
  </nav>
  
<div class="content">
    <div class="row" style="justify-content: center;">
        <div class="col-md-5">
            <div class="card card-user">
                <div class="card-header">
                    <div class="login-header">
                        <h1>Registro</h1>
                      </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                               
    
                                <div class="col-md-10 pr-1">
                                     <h3>Nombre</h3>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
    
                               
    
                                <div class="col-md-10 pr-1">
                                     <h3>Email</h3>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
    
                                
    
                                <div class="col-md-10 pr-1">
                                    <h3>Contraseña</h3>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
    
                                
    
                                <div class="col-md-10 pr-1">
                                 <h3>Confirmar contraseña</h3>   
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>

    

                                <div class="col-md-10 pr-1">
                                    <h3>Añade una foto</h3>  
                                     <input id="archivo"  type="file" accept="image/png , image/jpeg" enctype="multipart/form-data" name="archivo"/>
                                </div>
                           
    

                                <div class="col-md-10 pr-1 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            
                            
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
