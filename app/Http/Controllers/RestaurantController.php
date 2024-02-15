<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('restaurants.index', ['restaurants' => $restaurants]);
    }

    public function edit(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Проверяем, было ли загружено новое изображение
        if ($request->hasFile('image_path')) {
            // Получаем файл из запроса
            $image = $request->file('image_path');

            // Сохраняем изображение в папку storage/app/public/restaurants
            $path = $image->store('public/restaurants');

            // Обновляем путь к изображению в объекте ресторана
            $restaurant->image_path = Storage::url($path);
        }

        // Обновляем остальные поля ресторана
        $restaurant->name = $request->input('name');
        $restaurant->phone = $request->input('phone');

        // Сохраняем обновленные данные ресторана
        $restaurant->save();

        return redirect()->route('restaurants.index');
    }
}
