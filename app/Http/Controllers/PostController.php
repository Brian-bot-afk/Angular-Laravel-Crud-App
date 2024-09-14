<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Display a listing of posts
    public function index()
    {
        // Return a JSON response with posts, their users, and categories
        return response()->json(Post::with('user', 'category')->get());
    }

    // Show the form for creating a new post
    public function create()
    {
        $users = User::all();
        $categories = Category::all();
        // Return users and categories in a JSON response (no view names)
        return response()->json(compact('users', 'categories'));
    }

    // Store a newly created post in the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post = Post::create($request->only('title', 'body', 'user_id', 'category_id'));
        // Return the created post with a 201 Created status
        return response()->json($post, 201);
    }

    // Display a specific post
    public function show(Post $post)
    {
        $post->load('user', 'category', 'comments');
        // Return the post data in a JSON response
        return response()->json(compact('post'));
    }

    // Show the form for editing an existing post
    public function edit(Post $post)
    {
        $users = User::all();
        $categories = Category::all();
        // Return the post, users, and categories as JSON (no view names)
        return response()->json(compact('post', 'users', 'categories'));
    }

    // Update the specified post in the database
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post->update($request->only('title', 'body', 'user_id', 'category_id'));
        // Return the updated post as JSON
        return response()->json($post);
    }

    // Delete the specified post from the database
    public function destroy(Post $post)
    {
        $post->delete();
        // Return a JSON response indicating success
        return response()->json(['message' => 'Post deleted successfully']);
    }
}
