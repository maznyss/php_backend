<?php
namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return Tag::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:tags|max:255',
            'post_id' => 'required|exists:posts,id',
        ]);

        return Tag::create($validated);
    }

    public function show(Tag $tag)
    {
        return $tag->load('post');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return response(null, 204);
    }
}
