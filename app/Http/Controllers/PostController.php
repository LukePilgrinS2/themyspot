<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index() {

        $posts = DB::table('posts')->get();

        return view('posts', compact('posts'));
    }

    public function addPost(Request $request) {

        $content = $request->content;
        $criarPost = DB::table('posts')
        ->insert(['content' =>$content, 'user_id' => Auth::user()->id,
        'status' =>0, 'created_at' =>date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]);

        if($criarPost) {

            $posts_json = DB::table('users')
                ->leftJoin('profiles', 'profiles.user_id', 'users.id')
                ->leftJoin('posts', 'posts.user_id', 'users.id')
                ->orderBy('posts.created_at', 'desc')->take(3)
                ->get();

            return $posts_json;
        }
        }
}
