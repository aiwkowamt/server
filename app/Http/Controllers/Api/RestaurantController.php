<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function search(Request $request)
    {
        $name = $request->input('name');

        $restaurants = Restaurant::query()
            ->byName($name)
            ->paginate(10);

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
}
