<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $news_id)
    {
        $request->validate([
            'comment' => 'max:200',
        ]);
        Comment::create([
            'user_id' => Auth::user()->id,
            'news_id' => $news_id,
            'body' => $request->comment,
        ]);

        return redirect()->back();
    }

    public function destroy($comment_id)
    {
        Comment::findOrFail($comment_id)->delete();
        return redirect()->back();
    }

    public function like(Request $request)
    {
        $user_id = Auth::id();
        $comment_id = $request->comment_id;
        $comment = Comment::findOrFail($comment_id);
        $is_liked = $comment->isLiked();

        if (!$is_liked) {
            $comment->commentLikes()->attach($user_id);
        } else {
            $comment->commentLikes()->detach($user_id);
        }

        return response()->json();
    }
}
