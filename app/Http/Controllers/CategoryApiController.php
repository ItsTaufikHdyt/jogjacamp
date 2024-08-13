<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Symfony\Component\HttpFoundation\Response;

class CategoryApiController extends Controller
{
    public function index()
    {
        try {
            $category = Category::all();
            return response()->json($category, Response::HTTP_OK);
        } catch (\Throwable $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'is_publish' => 'boolean',
        ]);

        $category = Category::create($validatedData);
        return response()->json($category, Response::HTTP_CREATED );
    }

    public function show(Category $category)
    {
        return response()->json($category,Response::HTTP_OK);
    }

    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'is_publish' => 'boolean',
        ]);

        $category->update($validatedData);
        return response()->json($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'message' => 'Category deleted successfully'
        ], 200);
    }
}
