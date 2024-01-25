<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
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
        $restaurant = Restaurant::create([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'image_path' => $request->input('image_path'),
            'user_id' => $request->user()->id,
        ]);

        return response()->json(['message' => 'Ресторан успешно добавлен']);
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
