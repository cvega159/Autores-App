<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bibliografia extends Model
{
    use HasFactory;
    
    protected $table = 'bibliografias';
    
    public $timestamps = false;
    
    protected $fillable = ['user_id','libro_id'];
    
    public function user () {
        return $this->belongsTo ('App\Models\User', 'user_id');
    }
    
    public function libro () {
        return $this->hasMany ('App\Models\Libro', 'libro_id');
    }
}
