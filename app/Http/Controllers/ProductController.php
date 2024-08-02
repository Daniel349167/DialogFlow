<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function show($id)
    {
        return Product::findOrFail($id);
    }

    public function store(Request $request)
    {
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return response()->json($product, 200);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(null, 204);
    }
    // Método countByCategory
    public function countByCategory(Request $request)
    {
        $categoryName = $request->input('queryResult.parameters.category');

        $category = Category::where('name', $categoryName)->first();

        if (!$category) {
            return response()->json(['fulfillmentText' => 'Categoría no encontrada.']);
        }

        $productCount = Product::where('category_id', $category->id)->sum('quantity');

        return response()->json([
            'fulfillmentText' => "Hay $productCount productos en la categoría $categoryName."
        ]);
    }
}
