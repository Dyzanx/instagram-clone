<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model{
    use HasFactory;

    protected $table = 'likes';

    // Many to one relationships
    public function post(){
        return $this->belongsTo(Posts::class, 'post_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
