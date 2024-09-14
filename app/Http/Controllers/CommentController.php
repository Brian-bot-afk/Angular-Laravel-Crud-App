<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Display a listing of comments for a specific post
    public function index($postId)
    {
        // Return the post with its comments and user information
        $post = Post::with('comments.user')->find($postId);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        return response()->json($post->comments);  // Return comments as JSON
    }

    // Show the form for creating a new comment
    public function create($postId)
    {
        $post = Post::find($postId);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        // Return the post data as JSON (no view name)
        return response()->json(compact('post'));
    }

    // Store a newly created comment in the database
    public function store(Request $request, $postId)
    {
        $post = Post::find($postId);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $request->validate([
            'body' => 'required',
        ]);

        $comment = Comment::create([
            'body' => $request->body,
            'post_id' => $postId,
        ]);

        // Return the newly created comment as JSON with a 201 status
        return response()->json($comment, 201);
    }

    // Show the form for editing an existing comment
    public function edit($postId, $id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        // Return the comment data as JSON (no view name)
        return response()->json(compact('comment'));
    }

    // Update the specified comment in the database
    public function update(Request $request, $postId, $id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        $request->validate([
            'body' => 'required',
        ]);

        $comment->update($request->all());

        // Return the updated comment as JSON
        return response()->json($comment);
    }

    // Delete the specified comment from the database
    public function destroy($postId, $id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        $comment->delete();

        // Return a success message as JSON
        return response()->json(['message' => 'Comment deleted successfully']);
    }
}
