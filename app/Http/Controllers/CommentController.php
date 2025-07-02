<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Discussion;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Discussion $discussion)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
            'discussion_id' => 'required|exists:discussions,id',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $comment = new Comment();
        $comment->discussion_id = $request->discussion_id;
        $comment->user_id = auth()->user()->id;
        $comment->body = $request->body;

        // Insert parent_id if it's a reply
        if ($request->filled('parent_id')) {
            $comment->parent_id = $request->parent_id;
        }

        $comment->save();

        return back()->with('success', 'Comment posted!');
    }
}
