<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class DishController extends Controller
{

    public function getRestaurantDishes($restaurant_id)
    {
        $restaurant = Restaurant::findOrFail($restaurant_id);
        $dishes = Dish::where('restaurant_id', $restaurant_id)->with('category')->get();

        if ($dishes->isEmpty()) {
            return response()->json([
                'message' => 'Позиций для данного ресторана не найдено.',
            ], 200);
        }

        return response()->json([
            'restaurant' => $restaurant,
            'dishes' => $dishes,
        ], 200);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/restaurants', 'public');
        } else {
            $imagePath = null;
        }

        $dish = Dish::create([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'restaurant_id' => $request->input('restaurant_id'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'image_path' => $imagePath,
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

    public function dishRecommendations(Request $request)
    {
        $userId = $request->user()->id;

        $categoryIds = Order::where('user_id', $userId)
            ->with('dishes.category')
            ->get()
            ->flatMap(function ($order) {
                return $order->dishes->pluck('category_id');
            })
            ->groupBy(function ($categoryId) {
                return $categoryId;
            })
            ->map(function ($categoryIds) {
                return count($categoryIds);
            })
            ->sortDesc()
            ->take(3)
            ->keys();

        $dishes = Dish::whereIn('category_id', $categoryIds)
            ->with('category:id,name')
            ->get();

        return response()->json([
            'dishes' => $dishes,
        ], 200);
    }

}
