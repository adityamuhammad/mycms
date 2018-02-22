<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Category;

class HomePostController extends Controller
{
    public function homePost(){
        $categories = Category::all();
        $posts = Post::paginate(2);
        return view('welcome', compact('posts', 'categories'));
    }
    
    public function post($slug){
        $post = Post::findBySlugOrFail($slug);
        $comments = $post->comments()->whereIsActive(1)->get();
        $categories = Category::all();
        return view('post', compact('post', 'comments', 'categories'));
    }

    public function search(Request $request){
        $keyword = $request->search;
        $categories = Category::all();
        $posts = Post::where('title', 'like','%'.$keyword.'%')->paginate(2);
        $posts->appends($request->only('search'));

        return view('welcome', compact('posts', 'categories'));
    }

    public function category($id){
        $category = Category::findOrFail($id);
        $categories = Category::all();
        $posts = Post::where('category_id', '=' , $category->id)->paginate();
        return view('welcome', compact('posts', 'categories'));
    }
}
