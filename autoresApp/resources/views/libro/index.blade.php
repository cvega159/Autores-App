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

@if(Session::has('message'))
    <div class="alert alert-{{ session()->get('type') }}" role="alert">
        {{ session()->get('message') }}
    </div>
@endif
<!-- Modal -->
<div class="modal" id="modalDelete" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">¿Estas seguro de que quieres borrar?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>¿Seguro que quieres borrar <span class="name" >XXX</span>?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form id="form" action="" method="post">
            @method('delete')
            @csrf
            <input type="submit" class="btn btn-primary" value="Borrar libro"/>
        </form>
      </div>
    </div>
  </div>
</div>

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
        <a class="navbar-brand" href="javascript:;">Listado de los libros</a>
      </div>
      <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form action="{{route('search')}}">
              @method('GET')
              <div class="input-group no-border">
                <input name="search" type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="nc-icon nc-zoom-split"></i>
                  </div>
                </div>
              </div>
            </form>
        </div>
    </div>
  </nav>
 <div class="content">
       <div class="col-md-10" style="margin:0 auto">
      
     <div class="col-md-10">
       <a style="margin:0;" class="btn btn-primary" href="{{url('libro/create')}}">Dar de alta un libro</a>
        <div class="dropdown" style="float:right;">
          <button class="dropbtn" >Ordenar: </button>
          <div class="dropdown-content">
            <a class="dropdown-item" href="{{ route('libro.index', $ordernombredesc) }}">Nombre Z-A</a>
            <a class="dropdown-item" href="{{ route('libro.index', $ordernombreasc) }}">Nombre A-Z</a>
            <a class="dropdown-item" href="{{ route('libro.index', $orderpaginasdesc) }}">Paginas -1</a>
            <a class="dropdown-item" href="{{ route('libro.index', $orderpaginasasc) }}">Paginas 1-</a>
            
          </div>
        </div>
    </div>
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">nombre</th>
            <th scope="col">paginas</th>
            <th scope="col">codLibro</th>
            <th scope="col">precio</th>
            <th scope="col">editorial</th>
            <th scope="col">Autor</th>
            <th scope="col">Categoria</th>
            <th scope="col">Imagen</th>
            <th scope="col">Editar</th>
            <th scope="col">Borrar</th>
            <th scope="col">Ver libro</th>
          </tr>
        </thead>
        <tbody>
            @foreach($libros as $libro)
              <tr>
                <td>{{$libro->id}}</td>
                <td>{{$libro->nombre}}</td>
                <td>{{$libro->paginas}}</td>
                <td>{{$libro->codLibro}}</td>
                <td>{{$libro->precio}}</td>
                <td>{{$libro->editorial}}</td>
                @if($libro->user!=null)
                <td>{{$libro->user->name}}</td>
                @else
                <td>no hay registro</td>
                @endif
                <td>{{$libro->categoria->nombreCategoria}}</td>
                <td><img class="img" src="{{url('storage/libros/'. $libro->imgLibro)}}"></td>
                <td><a class="btn btn-warning" href="{{url('libro/'.$libro->id.'/edit')}}">Editar</a></td>
                <td>
                 
                 <a class="btn btn-danger" href="" data-toggle="modal" data-target="#modalDelete" 
                    onclick="deleteElement({{ $libro->id }}, '{{ $libro->nombre }}','libro')">Borrar</a>
                 
                </td>
                <td><a class="btn btn-info" href="{{url('showLibro/'.$libro->id)}}">Ver libro</a></td>
              </tr>  
            @endforeach
          
        </tbody>
        
      </table>
      
      {{-- $libros->appends(['sort' => 'name'])->onEachSide(2)->links() --}}
    
      {{ $libros->onEachSide(1)->links() }}
      <nav>
          <ul class="pagination">
              @foreach ($rpps as $linkData)
                  <li class="page-item @if($rpp == $linkData['rpp']) active @endif">
                      <a href="{{ route('libro.index', $linkData) }}" class="page-link">{{ $linkData['rpp'] }}</a>
                  </li>
              @endforeach
              <li class="page-item">
                  <a href="#" class="page-link">per page</a>
              </li>
          </ul>
      </nav>
      
      <a class="btn btn-primary" href="{{url('home')}}">Volver</a><br><br>
      
    </div>   
 </div>


@endsection
@section('js')
<script src="{{ url('assets/js/deleteElement.js') }}"></script>
@endsection