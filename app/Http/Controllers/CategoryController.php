<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:categories|max:255',
        ]);

        return Category::create($validated);
    }

    public function show(Category $category)
    {
        return $category->load('posts');
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|unique:categories|max:255',
        ]);

        $category->update($validated);
        return $category;
    }

    public function destroy(Category $category)
    {
        // Delete category
        $category->delete();
        return response(null, 204);
    }
}
