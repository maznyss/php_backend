<?php
namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function index()
    {
        return Vote::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required|exists:users,id',
            'vote_type' => 'required|in:upvote,downvote',
        ]);

        return Vote::create($validated);
    }

    public function show(Vote $vote)
    {
        return $vote;
    }

    public function destroy(Vote $vote)
    {
        $vote->delete();
        return response(null, 204);
    }
}
