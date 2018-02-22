<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use Session;

class AdminCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(3);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        Category::create($request->all());
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Category has been created"
        ]);
        return redirect('admin/categories');

        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $category = Category::findOrFail($id);
        return view('admin.categories.edit',compact('categories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Category::findOrFail($id)->update($request->all());
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Category has been updated"
        ]);
        return redirect('admin/categories');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        Session::flash("flash_notification", [
            "level" => "danger",
            "message" => "$category->name has been deleted"
        ]);
        return redirect('admin/categories');
        //
    }
}
