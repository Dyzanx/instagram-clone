<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Comments;
use App\Models\Likes;
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
    
    public function delete($id){
        $user = Auth::user();
        $post = Posts::find($id);
        $comments = Comments::where('posts_id', $id)->get();
        $likes = Likes::where('posts_id', $id)->get();
        
        if($user && $post && $post->user_id == $user->id){
            if($comments && count($comments) >= 1){
                foreach($comments as $comment){
                    $comment->delete();
                }
            }
            if($likes && count($likes) >= 1){
                foreach($likes as $like){
                    $like->delete();
                }
            }

            // remove from storage and delete
            Storage::disk('posts')->delete($post->image_path);
            $post->delete();
            
            $message = "Your post has been deleted successfully";
        }else{
            $message = "The post has not been deleted";
        }
        return redirect()->route('home')->with(['message' => $message]);
    }

    public function edit($id){
        $user = Auth::user();
        $post = Posts::find($id);

        if($user && $post && $post->user->id == $user->id){
            return view('post.edit', [
                'post' => $post
            ]);
        }else{
            return redirect()->route('home')->with(['message' => "You can't edit this post because it's not yours"]);
        }
    }

    public function update(Request $req){
        $validate = $this->validate($req, [
            'description' => ['string'],
            'image' => ['image']
        ]);
        
        $post_id = $req->input('post_id');
        $description = $req->input('description');

        $post = Posts::find($post_id);
        $post->description = $description;
        
        $image_path = $req->file('image');
        if($image_path){
            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('posts')->put($image_path_name, File::get($image_path));

            $post->image_path = $image_path_name;
        }

        $post->update();

        return redirect()->route('post.detail', ['id' => $post_id])->with(['message' => 'Post updated successfully']);
    }
}