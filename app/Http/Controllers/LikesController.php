<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Likes;

class LikesController extends Controller{
    public function __contruct(){
        $this->middleware('auth');
    }

    public function like($post_id){
        $user = Auth::user();
        $like = new Likes();
        $isset_like = Likes::where('user_id', $user->id)
                            ->where('posts_id', $post_id)
                            ->count();
                            
        if($isset_like == 0){
            $like->posts_id = $post_id;
            $like->user_id = $user->id;
    
            $like->save(); 
            
            return response()->json([
                'like' => $like
            ]);
        }else{
            return response()->json([
                'message' => 'You have already liked the post'
            ]);
        }
    }

    public function dislike($post_id){
        $user = Auth::user();
        $isset_like = Likes::where('user_id', $user->id)
                            ->where('posts_id', $post_id)
                            ->first();
                            
        if(isset($isset_like) && !empty($isset_like)){
            $isset_like->delete(); 
            
            return response()->json([
                'like' => $like,
                'message' => 'You have removed your like from this post'
            ]);
        }
    }

    public function index(){
        $user = Auth::user();
        $likes = Likes::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(5);

        return view('likes.index', [
            'likes' => $likes
        ]);
    }
}