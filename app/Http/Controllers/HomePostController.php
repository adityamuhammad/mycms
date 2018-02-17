<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Category;

class HomePostController extends Controller
{
    public function homePost(){
        $categories = Category::paginate(3);
        $posts = Post::paginate(2);
        return view('welcome', compact('posts', 'categories'));
    }
}
