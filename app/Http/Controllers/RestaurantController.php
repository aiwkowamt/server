<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::paginate(8);
        return view('restaurants.index', ['restaurants' => $restaurants]);
    }

    public function edit(Restaurant $restaurant)
    {
        return view('restaurants.edit', ['restaurant' => $restaurant]);
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('public/images/restaurants');
            $restaurant->image_path = str_replace('public/', '', $path);
        }

        $restaurant->name = $request->input('name');
        $restaurant->phone = $request->input('phone');
        $restaurant->save();

        return redirect()->route('restaurants.index');
    }

    public function destroy(Restaurant $restaurant)
    {
        $restaurant->dishes()->delete();
        $restaurant->delete();
        return redirect()->route('restaurants.index');
    }
}
