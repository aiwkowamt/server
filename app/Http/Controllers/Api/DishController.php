<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use Illuminate\Http\Request;

class DishController extends Controller
{

    public function index()
    {
        $dishes = Dish::all();
        if($dishes){
            return response()->json([
                'dishes' => $dishes,
            ], 200);
        }
        return response()->json([
            'message' => 'Позиций не найдено!',
        ], 400);
    }

    public function store(Request $request)
    {
        $dish = Dish::create([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'restaurant_id' => $request->input('restaurant_id'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'image_path' => $request->input('image_path'),
        ]);

        if ($dish) {
            return response()->json([
                'message' => 'Позиция успешно добавлена!',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Не удалось добавить позицию',
            ], 500);
        }
    }
}
