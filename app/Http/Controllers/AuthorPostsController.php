<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostsRequest;
use App\Http\Requests;
use App\Post;
use App\Photo;
use App\Category;
use Auth;
use Session;

class AuthorPostsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $posts = $user->posts;
        $categories = Category::lists('name', 'id')->all();
        return view('authors.index', compact('posts','categories'));
    }

    public function create()
    {
        $categories = Category::lists('name', 'id')->all();
        return view('authors.create', compact('categories'));
    }

    public function store(StorePostsRequest $request)
    {

        $input = $request->all();

        $user = Auth::user();

        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=> $name]);
            $input['photo_id'] = $photo->id;
        }
        $user->posts()->create($input);

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Post has been saved"
        ]);

        return redirect('authors/home/post');
        

    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::lists('name', 'id')->all();
        return view('authors.posts.edit', compact('post','categories'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);
            $photo = Photo::create(['file'=> $name]);
            
            $input['photo_id'] = $photo->id;

        }

        Auth::user()->posts()->whereId($id)->first()->update($input);
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Post has been updated"
        ]);
        return redirect('admin/posts');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if($post->photo->file){
            unlink(public_path() . $post->photo->file);
        } 
        $post->delete();

        Session::flash("flash_notification", [
            "level" => "danger",
            "message" => "$post->title has been deleted"
        ]);
        return redirect('admin/posts');
        
    }

    
}
