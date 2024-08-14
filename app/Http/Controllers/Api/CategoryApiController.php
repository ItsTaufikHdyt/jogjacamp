<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Symfony\Component\HttpFoundation\Response;

class CategoryApiController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/categories",
     *     tags={"Category"},
     *     summary="Get List Category Data",
     *     description="enter your description here",
     *     operationId="todo",
     *     @OA\Response(
     *         response="default",
     *         description="return array model todo"
     *     )
     * )
     */
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

     /**
     * @OA\Post(
     *     path="/api/categories",
     *     tags={"Category"},
     *     summary="Store Category",
     *     description="-",
     *     operationId="category/store",
     *     @OA\RequestBody(
     *          required=true,
     *          description="form todo",
     *          @OA\JsonContent(
     *              required={"name","is_publish"},
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="is_publish", type="bool"),
     *          ),
     *      ),
     *     @OA\Response(
     *         response="default",
     *         description=""
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'is_publish' => 'boolean',
        ]);

        $category = Category::create($validatedData);
        return response()->json($category, Response::HTTP_CREATED );
    }

      /**
     * @OA\Get(
     *     path="/api/categories/{id}",
     *     tags={"Category"},
     *     summary="Detail",
     *     description="-",
     *     operationId="category/show",
     *     @OA\Parameter(
     *          name="id",
     *          description="ID Enkripsi",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="return model todo"
     *     )
     * )
     */
    public function show(Category $category)
    {
        return response()->json($category,Response::HTTP_OK);
    }

    /**
     * @OA\Put(
     *     path="/api/categories/{id}",
     *     tags={"Category"},
     *     summary="Update Category",
     *     description="-",
     *     operationId="category/update",
     *     @OA\Parameter(
     *          name="id",
     *          description="ID Enkripsi",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\RequestBody(
     *          required=true,
     *          description="form todo",
     *          @OA\JsonContent(
     *              required={"name","is_publish"},
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="is_publish", type="bool"),
     *          ),
     *      ),
     *     @OA\Response(
     *         response="default",
     *         description=""
     *     )
     * )
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'is_publish' => 'boolean',
        ]);

        $category->update($validatedData);
        return response()->json($category);
    }

     /**
     * @OA\Delete(
     *     path="/api/categories/{id}",
     *     tags={"Category"},
     *     summary="Delete todo",
     *     description="-",
     *     operationId="category/delete",
     *     @OA\Parameter(
     *          name="id",
     *          description="ID Enkripsi",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description=""
     *     )
     * )
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'message' => 'Category deleted successfully'
        ], 200);
    }
}
