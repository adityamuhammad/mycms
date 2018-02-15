<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CommentReply;

use App\Http\Requests;

class CommentRepliesController extends Controller
{
    public function postReply(Request $request)
    {
        $user = Auth::user();

        $data = [
            'comment_id' => $request->post_id,
            'author' => $user->name,
            'email' => $user->email,
            'photo' => $user->photo['file'],
            'body' => $request->body
        ];
        CommentReply::create($data);
        $request->session()->flash('comment_message', 'Your reply has been submited, wait administrator to approve it');
        return redirect()->back();
        
    }
}
