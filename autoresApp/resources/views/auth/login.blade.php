@extends('base')

@section('content3')
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
            <a class="navbar-brand" href="javascript:;">Identificate!</a>
          </div>
          
        </div>
      </nav>

    <div class="content">
        
        <div class="row" style="justify-content: center;">
          <div class="col-md-5">
            <div class="card card-user">
              <div class="card-header">
                  
                <div class="login-header">
                    <h1>Login</h1>
                  </div>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                @csrf
                  <div class="row">
                      
                    <div class="col-md-10 pr-1">
                        <h3>Nombre de usuario</h3>
                      <div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                    <br>
                     <div class="col-md-10 pr-1">
                        <h3>Contraseña</h3>
                      <div class="form-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                   
                  <div class="col-md-12 pr-1">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" class="btn btn-primary btn-round">{{ __('Login') }}</button>
                      
                      @if (Route::has('password.request'))
                        <a class="no-access" href="{{ route('password.request') }}">
                            {{ __('¿Has olvidado tu contraseña?') }}
                        </a>
                    @endif
                    </div>
                  </div>
                  
                  <div class="col-md-12 pr-1">
                    <div class="update ml-auto mr-auto">
                      <a class="no-access" href="{{ route('register') }}">
                            <h4>{{ __('¿No estas aun registrado?') }}</h4>
                    </a>
                  </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        
        </div>

@endsection