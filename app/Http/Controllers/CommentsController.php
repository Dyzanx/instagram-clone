<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller{
    public function __contruct(){
        $this->middleware('auth');
    }

    public function save(Request $req){
        $validate = $this->validate($req, [
            'content' => ['required', 'string'],
            'post_id' => ['required', 'integer']
        ]);
        
        $comment = new Comments();
        $content = $req->input('content');
        $post_id = $req->input('post_id');
        $user_id = Auth::user()->id;
        
        $comment->user_id = $user_id;
        $comment->posts_id = $post_id;
        $comment->content = $content;

        $comment->save();

        return redirect()->route('post.detail', [
            'id' => $post_id
        ])->with(['message' => 'Your comment has been published successfully']);
    }

    public function delete($id){
        $user = Auth::user();
        $comment = Comments::find($id);
        
        if($user && ($comment->user_id == $user->id 
        || $comment->post->user_id == $user->id)){
            $comment->delete();
            
            return redirect()->route('post.detail', [
                'id' => $comment->post->id
            ])->with(['message' => "The comment has been deleted successfully"]);
        }else{
            return redirect()->route('post.detail', [
                'id' => $comment->post->id
            ])->with(['message' => "The comment hasn't been deleted"]);
        }
    }
}