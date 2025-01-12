<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return Comment::with(['post', 'user'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required|exists:users,id',
            'reply' => 'nullable|exists:comments,id',
            'text' => 'required|string',
        ]);

        return Comment::create($validated);
    }

    public function show(Comment $comment)
    {
        return $comment->load(['post', 'user', 'replies']);
    }

    public function update(Request $request, Comment $comment)
    {
        $validated = $request->validate([
            'text' => 'required|string',
        ]);

        $comment->update($validated);
        return $comment;
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response(null, 204);
    }
}
