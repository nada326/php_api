<?php

namespace App\Http\Controllers\API;

use App\Helper\ImageUpload;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Response\ApiResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ApiResponse, ImageUpload;

    public function index()
    {
        $products = Product::all();
        return $this->sendResponse(ProductCollection::collection($products), 'All Products', 200);
    }

    public function store(Request $request)
    {
        $data = Validator($request->all(), [
            'name'=>'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);
        if($data->fails()){
            return $this->sendError('product creating has been failed', $data->errors(),422);
        }
        if($request->hasFile('image')) {
            $imageName = $this->upload($request);
        }

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imageName ?? 'default.png',
            'category_id' => $request->category_id,
        ]);
        return $this->sendResponse(new ProductResource($product), 'product has been created successfully', 200);
    }

    public function show(Product $product)
    {
        return $this->sendResponse(new ProductResource($product), 'Product fetched successfully', 200);
    }

    public function update(Request $request, Product $product)
    {
        $data = Validator($request->all(), [
            'name'=>'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);
        if($data->fails()){
            return $this->sendError('product updating has been failed', $data->errors(),422);
        }
        if($request->hasFile('image') && $product->image !== 'default.png') {
            $this->upload($request);
        }
        $product->update($request->all());
        return $this->sendResponse(new ProductResource($product), 'Product has been updated successfully', 200);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return $this->sendResponse([],'product has been deleted successfully', 200);
    }
    public function getProductByVurfiayId(string $vuforiaId): ?Product

    {

        $product = Product::where('vuforia_id',$vuforiaId )->first();
        return $this->sendResponse($product->toArray(), 'product fechted successfully', 200);

    }
}
