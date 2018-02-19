<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomePostController@homePost');
Route::auth();

Route::get('/home', 'HomeController@index');



Route::get('/post/{slug}', [
    'as'=>'home.post',
    'uses' =>'HomePostController@post']);

Route::group(['middleware'=>'admin'], function(){

    Route::resource('/admin/users', 'AdminUsersController');
    Route::resource('/admin/posts', 'AdminPostsController');
    Route::resource('/admin/categories', 'AdminCategoriesController');
    Route::resource('/admin/media', 'AdminMediasController');
    Route::resource('/admin/comments', 'PostCommentsController');
    Route::resource('/admin/comment/replies', 'CommentRepliesController');
    Route::delete('admin/delete/media', 'AdminMediasController@deleteMultiple');
    Route::get('/admin', function(){
        return view('admin.index');
    });

});

Route::group(['middleware'=> 'auth'], function(){
    Route::post('comment/reply', 'CommentRepliesController@postReply');
});

Route::group(['middleware'=> 'author'], function(){
    Route::get('author/home/post', 'AuthorPostsController@index');
    Route::get('author/home/post/create', 'AuthorPostsController@create');
    Route::post('author/home/post', 'AuthorPostsController@store');
    Route::get('author/home/post/{id}/edit',[
        'as' => 'author.edit.post',
        'uses' => 'AuthorPostsController@edit'
    ]);
    Route::put('author/home/post/{id}', 'AuthorPostsController@update');
    Route::delete('author/home/post{id}', 'AuthorPostsController@destroy');
    
});


