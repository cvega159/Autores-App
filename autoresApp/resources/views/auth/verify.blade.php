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
        <a class="navbar-brand" href="javascript:;">Verficacion</a>
      </div>
      
    </div>
  </nav>
  <div class="content">
  <div class="col-md-10" style="margin:0 auto">
    <h2>Espera a que confirmemos tu email</h2>
    <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico del editor.') }}
                        </div>
                    @endif
            
                    {{ __('Antes de continuar, verifique su correo electrónico para obtener un enlace de verificación.') }}<br>
                    {{ __('Si no recibiste el correo electrónico') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Haga clic aquí para solicitar otro') }}</button>.
                    </form>
                </div>
            </div>
        </div>
  </div>
</div>

@endsection
