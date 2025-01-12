<?php
namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return Notification::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required|in:system,mention,upvote,downvote,answer_accepted,new_follower',
            'is_read' => 'boolean',
        ]);

        return Notification::create($validated);
    }

    public function show(Notification $notification)
    {
        return $notification;
    }

    public function update(Request $request, Notification $notification)
    {
        $validated = $request->validate([
            'is_read' => 'boolean',
        ]);

        $notification->update($validated);
        return $notification;
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();
        return response(null, 204);
    }
}
