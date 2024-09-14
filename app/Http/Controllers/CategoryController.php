<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Display a listing of categories
    public function index()
    {
        $categories = Category::all();
        return response()->json('categories.index', compact('categories'));
    }

    // Show the form for creating a new category
    public function create()
    {
        return response()->json('categories.create');
    }

    // Store a newly created category in the database
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create a new category using mass assignment
        Category::create($request->only('name'));

        return response()->json('categories.index')
            ->with('success', 'Category created successfully.');
    }

    // Show the form for editing an existing category
    public function edit(Category $category)
    {
        return response()->json('categories.edit', compact('category'));
    }

    // Update the specified category in the database
    public function update(Request $request, Category $category)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update the category
        $category->update($request->only('name'));

        return response()->json('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    // Delete the specified category from the database
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json('categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    // Display a specific category along with related posts
    public function show(Category $category)
    {
        $category->load('posts'); // Eager load posts related to this category
        return response()->json('categories.show', compact('category'));
    }
}
