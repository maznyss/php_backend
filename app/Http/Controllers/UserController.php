<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'in:admin,user,moderator',
        ]);

        // Hash password and create user
        $validated['password'] = Hash::make($validated['password']);
        return User::create($validated);
    }

    public function show(User $user)
    {
        return $user;
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username' => 'sometimes|unique:users,username,' . $user->id,
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|min:8',
            'role' => 'in:admin,user,moderator',
        ]);

        // Hash password if it's being updated
        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        // Update user
        $user->update($validated);
        return $user;
    }

    public function destroy(User $user)
    {
        // Delete user
        $user->delete();
        return response(null, 204);
    }
}

