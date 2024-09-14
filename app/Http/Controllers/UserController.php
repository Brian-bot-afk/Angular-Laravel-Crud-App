<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Display a listing of users
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    // Show the form for creating a new user
    public function create()
    {
        // Return an appropriate message or empty object if no data is needed
        return response()->json(['message' => 'Show form to create a new user']);
    }

    // Store a newly created user in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        // Create the user and return the created user data
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json($user, 201); // Return the created user with a 201 status code
    }

    // Show the form for editing an existing user
    public function edit($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Return the user data for editing
        return response()->json($user);
    }

    // Update the specified user in the database
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
        ]);

        $user->update($request->all());

        // Return the updated user data
        return response()->json($user);
    }

    // Delete the specified user from the database
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        // Return a success message
        return response()->json(['message' => 'User deleted successfully']);
    }

    // Display a specific user
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Return the user data
        return response()->json($user);
    }
}
