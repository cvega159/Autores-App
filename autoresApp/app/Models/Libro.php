<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;
    
    protected $table = 'libros';
    
    public $timestamps = false;
    
    protected $fillable = ['user_id', 'nombre','paginas','codLibro','precio','categoria_id','editorial','imgLibro'];
    
    public function user () {
        return $this->belongsTo ('App\Models\User', 'user_id');
    }
    
    public function categoria () {
        return $this->belongsTo ('App\Models\Categoria', 'categoria_id');
    }
    
    
}
