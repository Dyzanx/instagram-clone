<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\User;

use function Ramsey\Uuid\v1;

class UserController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }

    public function config(){
        return view('user.config');
    }

    public function update(Request $req){
        $user = Auth::user();
        $id = $user->id;
        $validate = $this->validate($req, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nickname' => ['required', 'string', 'max:255', 'unique:users,nickname,'.$id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
        ]);

        $name = $req->input('name');
        $surname = $req->input('surname');
        $nickname = $req->input('nickname');
        $email = $req->input('email');

        $user->name = $name;
        $user->surname = $surname;
        $user->nickname = $nickname;
        $user->email = $email;

        $image_path = $req->file('image');
        if($image_path){
            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('users')->put($image_path_name, File::get($image_path));

            $user->image = $image_path_name;
        }

        $user->update();

        return redirect()->route('user.config')->with('message', 'User updated successfully');
    }

    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }

    public function profile($id){
        $user = User::find($id);
        
        return view('user.profile', [
        'user' => $user
        ]);
    }

    public function users($search = null){
        if(!empty($search)){
            $users = User::where('nickname', 'LIKE', "%$search%")
                            ->orWhere('name', 'LIKE', "%$search%")
                            ->orWhere('surname', 'LIKE', "%$search%")
                            ->orderBy('id', 'desc')->paginate(7);
        }else{
            $users = User::orderBy('id', 'desc')->paginate(7);
        }

        return view('user.index', [
            'users' => $users
        ]);
    }
}