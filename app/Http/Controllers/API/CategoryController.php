<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Response\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponse;

    public function index(): JsonResponse
    {
        $categories = Category::all();
        return $this->sendResponse($categories, 'categories has been fetched successfully', 200);
    }

    public function store(Request $request): JsonResponse
    {
        $data = Validator($request->all(), [
            'name'=>'required',
        ]);
        if($data->fails()){
            return $this->sendError('category creating has been failed', $data->errors(),422);
        }
        $category = Category::create($request->all());
        return $this->sendResponse($category, 'category has been created successfully', 200);
    }

    public function show(Category $category): JsonResponse
    {
        return $this->sendResponse($category, 'Category fetched successfully', 200);

    }

    public function update(Request $request, Category $category)
    {
        $data = Validator($request->all(), [
            'name'=>'required',
        ]);
        if($data->fails()){
            return $this->sendError('category updating has been failed', $data->errors(),422);
        }
        $category->update($request->all());
        return $this->sendResponse($category, 'category has been created successfully', 200);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return $this->sendResponse([],'Category has been deleted successfully', 200);
    }
}
