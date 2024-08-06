<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function show($id)
    {
        return Category::findOrFail($id);
    }

    public function store(Request $request)
    {
        $category = Category::create($request->all());
        return response()->json($category, 201);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return response()->json($category, 200);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json(null, 204);
    }

    public function listCategories(Request $request)
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

        $categories = Category::all();
        Log::info('Categories retrieved', ['categories' => $categories]);

        if ($categories->isEmpty()) {
            return response()->json([
                'fulfillment_response' => [
                    'messages' => [
                        [
                            'text' => [
                                'text' => ['No se encontraron categorías.']
                            ]
                        ]
                    ]
                ]
            ], 200, ['Content-Type' => 'application/json']);
        }

        $categoryNames = $categories->pluck('name');
        Log::info('Category names', ['categoryNames' => $categoryNames]);

        $responseText = "Las categorías disponibles son:\n- " . $categoryNames->join("\n- ") . '.';

        $response = [
            'fulfillment_response' => [
                'messages' => [
                    [
                        'text' => [
                            'text' => [$responseText]
                        ]
                    ]
                ]
            ],
            'sessionInfo' => $request->input('sessionInfo')
        ];

        return response()->json($response, 200, ['Content-Type' => 'application/json']);
    }
}
