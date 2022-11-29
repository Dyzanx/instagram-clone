<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model{
    use HasFactory;

    protected $table = 'comments';

    // Many to one relationships
    public function post(){
        return $this->belongsTo(Posts::class, 'posts_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}