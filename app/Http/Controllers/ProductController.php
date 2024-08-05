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
        Log::info('Request from Dialogflow', ['request' => $request->all()]);

        $intentInfo = $request->input('intentInfo');
        Log::info('Intent Info from request', ['intentInfo' => $intentInfo]);

        if (!$intentInfo) {
            return response()->json([
                'fulfillment_response' => [
                    'messages' => [
                        [
                            'text' => [
                                'text' => ['No se pudo extraer la información del intento.']
                            ]
                        ]
                    ]
                ]
            ], 200, ['Content-Type' => 'application/json']);
        }

        $parameters = $intentInfo['parameters'] ?? null;
        Log::info('Parameters from request', ['parameters' => $parameters]);

        if (!$parameters) {
            return response()->json([
                'fulfillment_response' => [
                    'messages' => [
                        [
                            'text' => [
                                'text' => ['No se pudieron extraer los parámetros.']
                            ]
                        ]
                    ]
                ]
            ], 200, ['Content-Type' => 'application/json']);
        }

        $categoryResolvedValue = $parameters['category']['resolvedValue'] ?? null;
        Log::info('Extracted category resolvedValue', ['resolvedValue' => $categoryResolvedValue]);

        if (!$categoryResolvedValue) {
            return response()->json([
                'fulfillment_response' => [
                    'messages' => [
                        [
                            'text' => [
                                'text' => ['No se pudo extraer el valor de la categoría.']
                            ]
                        ]
                    ]
                ]
            ], 200, ['Content-Type' => 'application/json']);
        }

        $categoryName = $categoryResolvedValue; // Corregido: asignar directamente el valor
        Log::info('Extracted category name', ['categoryName' => $categoryName]);

        if (!$categoryName) {
            return response()->json([
                'fulfillment_response' => [
                    'messages' => [
                        [
                            'text' => [
                                'text' => ['Categoría no proporcionada.']
                            ]
                        ]
                    ]
                ]
            ], 200, ['Content-Type' => 'application/json']);
        }

        $category = Category::where('name', $categoryName)->first();

        if (!$category) {
            return response()->json([
                'fulfillment_response' => [
                    'messages' => [
                        [
                            'text' => [
                                'text' => ['Categoría no encontrada.']
                            ]
                        ]
                    ]
                ]
            ], 200, ['Content-Type' => 'application/json']);
        }

        $productCount = Product::where('category_id', $category->id)->sum('quantity');
        Log::info('Product count', ['productCount' => $productCount]);

        $response = [
            'fulfillment_response' => [
                'messages' => [
                    [
                        'text' => [
                            'text' => ["Hay $productCount productos en la categoría $categoryName."]
                        ]
                    ]
                ]
            ],
            'sessionInfo' => $request->input('sessionInfo')
        ];

        return response()->json($response, 200, ['Content-Type' => 'application/json']);
    }
}
