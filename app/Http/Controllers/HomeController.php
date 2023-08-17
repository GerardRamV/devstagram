<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function __invoke(){
        $ids = auth()->user()->followings->pluck('id')->toArray();
        $postFollow = Post::whereIn('user_id', $ids)->latest()->paginate(20);
        $postNotFollow = Post::whereNotIn('user_id', $ids)->latest()->paginate(20);
        return view('home', ['postFollow' => $postFollow, 'postNotFollow' => $postNotFollow]);
    }
}
