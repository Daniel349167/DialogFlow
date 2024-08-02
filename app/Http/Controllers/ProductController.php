<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Log;


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
        // Registrar la solicitud completa para depuración
        Log::info('Request from Dialogflow', ['request' => $request->all()]);

        // Extraer el nombre de la categoría desde los parámetros de la solicitud
        $categoryName = $request->input('queryResult.parameters.category');

        if (!$categoryName) {
            return response()->json(['fulfillmentText' => 'Categoría no proporcionada.']);
        }

        // Buscar la categoría en la base de datos
        $category = Category::where('name', $categoryName)->first();

        if (!$category) {
            // Responder si la categoría no se encuentra
            return response()->json(['fulfillmentText' => 'Categoría no encontrada.']);
        }

        // Contar los productos en la categoría encontrada
        $productCount = Product::where('category_id', $category->id)->sum('quantity');

        // Responder con la cantidad de productos
        return response()->json([
            'fulfillmentText' => "Hay $productCount productos en la categoría $categoryName."
        ]);
    }
}
