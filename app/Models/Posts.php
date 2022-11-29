<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model{
    use HasFactory;

    // Tabla a la que va a modificar
    protected $table = 'posts';

    // one to many relationship
    public function comments(){
        return $this->hasMany(Comments::class)->orderBy('id', 'desc');
    }

    // one to many relationship
    public function likes(){
        return $this->hasMany(Likes::class);
    }

    // Many to one relationship
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

}