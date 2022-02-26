<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
          background:url('http://cdn.wallpapersafari.com/13/6/Mpsg2b.jpg');
          margin:0px;
          font-family: 'Ubuntu', sans-serif;
        	background-size: cover;
        	background-repeat:no-repeat;
        	
        }
        h1, h2, h3, h4, h5, h6, a,p {
          margin:0; padding:0;
          text-decoration:none;
          color:white;
          
        }
    
        .login {
          margin:0 auto;
          max-width:500px;
        }
        .login-header {
          color:#fff;
          text-align:center;
          font-size:300%;
        }
        /* .login-header h1 {
           text-shadow: 0px 5px 15px #000; 
        }*/
        .login-form {
          border:.5px solid #fff;
          
          border-radius:10px;
          box-shadow:0px 0px 10px #000;
        }
        .login-form h3 {
          text-align:left;
          margin-left:40px;
          color:#fff;
        }
        .login-form {
          box-sizing:border-box;
          padding-top:15px;
        	padding-bottom:10%;
          margin:5% auto;
          text-align:center;
        }
        .login input[type="text"],
        .login input[type="password"],.login input[type="email"] {
          max-width:400px;
        	width: 80%;
          line-height:3em;
          font-family: 'Ubuntu', sans-serif;
          margin:1em 2em;
          border-radius:5px;
          border:2px solid #f2f2f2;
          outline:none;
          padding-left:10px;
        }
        .login-form button[type="submit"] {
          height:30px;
          width:200px;
          background:#fff;
          border:1px solid #f2f2f2;
          border-radius:20px;
          color: slategrey;
          text-transform:uppercase;
          font-family: 'Ubuntu', sans-serif;
          cursor:pointer;
        }
        .sign-up{
          color:#f2f2f2;
          margin-left:-70%;
          cursor:pointer;
          text-decoration:underline;
        }
        .no-access {
          color:#E86850;
          margin:20px 0px 20px -57%;
          text-decoration:underline;
          cursor:pointer;
        }
        .try-again {
          color:#f2f2f2;
          text-decoration:underline;
          cursor:pointer;
        }
        
        .img{
          width:1879px;
          height:970px;
          position:absolute;
          z-index:-999;
        }
        
        .titulo{
          text-align:center;
          font-size:8em;
          padding:50px;
          margin-top:150px;
          color:black;
        }
        
        .button {
            border: 2px black;
            display: block;
            position: relative;
            padding: 1.5em 1.5em;
            appearance: none;
            border: 0;
            background: transparent;
            color: #e55743;
            text-transform: uppercase;
            letter-spacing: .25em;
            outline: none;
            cursor: pointer;
            font-weight: bold;
            border-radius: 0;
            box-shadow: inset 0 0 0 var(--border-size) currentcolor;
            transition: background .8s ease;
            
        }
        
        
        /*Media Querie*/
        @media only screen and (min-width : 150px) and (max-width : 530px){
          .login-form h3 {
            text-align:center;
            margin:0;
          }
          .sign-up, .no-access {
            margin:10px 0;
          }
          .login-button {
            margin-bottom:10px;
          }
        }
    </style>
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                    
                </a>
                <!--
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>-->

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item" style="list-style:none; text-align:right">
                                    <a class="button" href="{{ route('login') }}"><h3>{{ __('Login') }}</h3></a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item" style="list-style:none; text-align:right">
                                    <a class="button" href="{{ route('register') }}"><h3>{{ __('Register') }}</h3></a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ route('home') }}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
