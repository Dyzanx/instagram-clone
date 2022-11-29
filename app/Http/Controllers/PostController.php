<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PostController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function create(){
        return view('post.create');
    }

    public function save(Request $req){
        $validate = $this->validate($req, [
            'description' => ['required'],
            'image' => ['required', 'image']
        ]);

        $post = new Posts();
        $post->user_id = Auth::user()->id;
        $post->description = $req->input('description');
        
        $image_path = $req->file('image');
        if($image_path){
            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('posts')->put($image_path_name, File::get($image_path));

            $post->image_path = $image_path_name;
        }

        $post->save();

        return redirect()->route('home')->with('message', 'Post created successfully');
    }

    public function detail($id){
        $post = Posts::find($id);

        return view('post.detail', [
            'post' => $post
        ]); 
    }
}