<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CommentReply;
use App\Comment;
use Auth;
use Session;

use App\Http\Requests;

class CommentRepliesController extends Controller
{
    public function postReply(Request $request)
    {
        $user = Auth::user();

        $data = [
            'comment_id' => $request->comment_id,
            'author' => $user->name,
            'email' => $user->email,
            'photo' => $user->photo['file'],
            'body' => $request->body
        ];
        CommentReply::create($data);
        $request->session()->flash('comment_message', '');
        Session::flash("flash_notification", [
            "level" => "info",
            "message" => "Your reply has been submited, wait administrator to approve it"
        ]);
        return redirect()->back();
        
    }

    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        $replies = $comment->replies;

        return view('admin.comments.replies.show', compact('replies'));
    }

    public function update(Request $request, $id)
    {
        CommentReply::findOrFail($id)->update($request->all());
        return redirect()->back();
    }

    public function destroy($id)
    {
        CommentReply::findOrFail($id)->delete();
        return redirect()->back();
    }

}
