<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use  App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function create($postId)
    {
        // dd($postId);
        $post = Post::findOrFail($postId);
        $req = request();
        // dd($req);
        $post->Comments()->create([
            'user_id' => Auth::user()->id,
            'body' => $req->comment,
            'commentable_id' => $postId,
            'commentable_type' => Post::class,
        ]);
        return redirect('posts/' . $postId);
    }
    public function delete($postId, $commentId)
    {
        Comment::where('id', $commentId)->delete();
        return redirect('posts/' . $postId);
    }
    public function view($postId, $commentId)
    {
        $post = Post::findOrFail($postId);
        $comment = Comment::where('id', $commentId)->first();
        return view('comments.edit', ['post' => $post, 'comment' => $comment]);
    }
    public function edit($postId, $commentId)
    {
        // $post = Post::find($postId);
        $req = request();
        Comment::where('id', $commentId)->first()->update([
            'body' => $req->comment
        ]);
        return redirect('posts/' . $postId);
    }
}
