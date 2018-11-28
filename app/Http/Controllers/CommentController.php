<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Forum;
use App\Comment;
use Auth;

class CommentController extends Controller
{
    public function addComment(Request $request, Forum $forum)
    {
    	$request->validate([
    		'content' => 'required|min:5'
    	]);
    	
    	$comment = new Comment;
    	$comment->user_id = Auth::user()->id;
    	$comment->content = $request->content;

    	$forum->comments()->save($comment);

    	return back()->withInfo('Komentar terkirim.');
    }

    public function replyComment(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required|min:5'
        ]);
        
        $reply = new Comment;
        $reply->user_id = Auth::user()->id;
        $reply->content = $request->content;

        $comment->comments()->save($reply);

        return back()->withInfo('Komentar balasan terkirim.');
    }

}
