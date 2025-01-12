<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return Post::with(['user', 'category'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tags' => 'nullable|string',
        ]);

        return Post::create($validated);
    }

    public function show(Post $post)
    {
        return $post->load(['user', 'category', 'comments']);
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'tags' => 'nullable|string',
        ]);

        $post->update($validated);
        return $post;
    }

    public function destroy(Post $post)
    {
        // Delete post
        $post->delete();
        return response(null, 204);
    }
}
