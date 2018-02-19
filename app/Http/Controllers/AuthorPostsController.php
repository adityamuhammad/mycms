<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\StorePostsRequest;
use App\Post;
use App\User;
use App\Photo;
use App\Category;
use Auth;
use Session;
use Gate;

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
        if (Gate::denies('edit-post', $post)) {
            return redirect('/');
        }
            return view('authors.edit', compact('post', 'categories'));
        


    }

    public function update(Request $request,$id)
    {
        $post = Post::find($id);
        if (Gate::denies('update-post', $post)) {
            return redirect('/');
        }
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
        return redirect('author/home/post');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         return "its works";
    }

    
}
