<?php

namespace App\Repositories\Category;

use App\Repositories\Core\Category\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $category;

    public function __contruct(
        category $category
    ) {
        $this->category = $category;
    }

    public function storeCategory($request)
    {
        Category::create([
            'name' => $request->name,
            'is_publish' => $request->is_publish,
        ]);
    }

    public function updateCategory($request, $id)
    {
        $dataCategory = Category::find($id);
        $dataCategory->update([
            'name' => $request->name,
            'is_publish' => $request->is_publish,
        ]);
    }

    public function destroyCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
    }
}
