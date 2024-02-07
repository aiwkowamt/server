<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RestaurantController extends Controller
{
    public function search(Request $request)
    {
        $name = $request->input('name');

        $restaurants = Restaurant::query()
            ->byName($name)
            ->withAverageRating()
            ->paginate(3);

        return response()->json([
            'restaurants' => $restaurants,
        ]);
    }

    public function getUserRestaurants(Request $request)
    {
        $user_id = $request->user()->id;

        $restaurants = Restaurant::where('user_id', $user_id)->get();

        return response()->json([
            'restaurants' => $restaurants,
        ]);
    }

    public function index(Request $request)
    {
        $user_id = $request->user()->id;
        $restaurants = Restaurant::where('user_id', $user_id)->get();
        return response()->json([
            'restaurants' => $restaurants,
        ]);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/restaurants', 'public');

            $restaurant = Restaurant::create([
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'phone' => $request->input('phone'),
                'user_id' => $request->user()->id,
                'image_path' => $imagePath,
            ]);

            return response()->json(['message' => 'Ресторан успешно добавлен']);
        }

        return response()->json(['message' => 'Ошибка'], 400);
    }

    public function edit(string $id)
    {
        $restaurant = Restaurant::find($id);
        if (!$restaurant) {
            return response()->json(['message' => 'Ресторан не найден.'], 400);
        }
        return  response()->json(['restaurant' => $restaurant]);
    }

    public function update(Request $request, string $id)
    {
        $restaurant = Restaurant::find($id);

        if (!$restaurant) {
            return response()->json(['message' => 'Ресторан не найден.'], 400);
        }
        $restaurant->update($request->all());
        return response()->json(['message' => 'Ресторан успешно обновлен.']);
    }


    public function getAverageRating($restaurant_id) {
        $averageRating = DB::table('orders')
            ->join('comments', 'orders.comment_id', '=', 'comments.id')
            ->select('orders.restaurant_id', DB::raw('AVG(comments.grade) AS average_grade'))
            ->where('orders.restaurant_id', $restaurant_id)
            ->whereNotNull('orders.comment_id')
            ->groupBy('orders.restaurant_id')
            ->first();

        return response()->json(['average_rating' => $averageRating]);
    }
}
