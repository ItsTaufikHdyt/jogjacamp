<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use App\Repositories\Category\CategoryRepository as CategoryInterface;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(
        CategoryInterface $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }


    public function index(Request $request)
    {
        $search = $request->input('search');
        $categories = Category::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('categories.index', compact('categories', 'search'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(CategoryRequest $request)
    {
        //Category::create($request->validated());
        try {
            $anak = $this->categoryRepository->storeCategory($request);
            return redirect()->route('categories.index')->with('success', 'Category created successfully.');
        } catch (\Throwable $e) {
            return redirect()->route('categories.index')->with('success', 'Category created Failed.');
        }
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request,$id)
    {
        //$category->update($request->validated());
        try {
            $this->categoryRepository->updateCategory($request,$id);
            return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
        } catch (\Throwable $e) {
            return redirect()->route('categories.index')->with('success', 'Category updated Failed.');
        }
    }

    public function destroy($id)
    {
        try {
            $this->categoryRepository->destroyCategory($id);
            return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
        } catch (\Throwable $e) {
            return redirect()->route('categories.index')->with('success', 'Category deleted Failed.');
        }
    }
}
