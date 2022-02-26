<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\User;

class SearchController extends Controller
{
    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');
        $data['libros']= Libro::all();
        //$data['pokemons']= Pokemon::all();
        
        // Search in the title and body columns from the posts table
        $users = User::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->orWhere('rol', 'LIKE', "%{$search}%")
            ->get();
        /*
        $habilidades = Ability::query()
            ->where('nombre', 'LIKE', "%{$search}%")
            ->get();
            
        $generos = Gender::query()
            ->where('nombre', 'LIKE', "%{$search}%")
            ->get();
            
        $tipos = tipoPokemon::query()
            ->where('nombre', 'LIKE', "%{$search}%")
            ->get();
        */
        $libros = Libro::query()
            ->where('nombre', 'LIKE', "%{$search}%")
            ->orWhere('paginas', 'LIKE', "%{$search}%")
            ->orWhere('codLibro', 'LIKE', "%{$search}%")
            ->orWhere('precio', 'LIKE', "%{$search}%")
            ->orWhere('editorial', 'LIKE', "%{$search}%")
            ->get();
            /*
        $pokemons = Pokemon::query()
            ->where('nombre', 'LIKE', "%{$search}%")
            //->orWhere($data['pokemons']->tipo->nombre, 'LIKE', "%{$search}%")
            ->get();
        */
        
    
        // Return the search view with the resluts compacted
        //return view('search.search', compact('users','pokeunicos','habilidades','generos','tipos','pokemons'));
        return view('search.search', compact('libros'));
    }
}
