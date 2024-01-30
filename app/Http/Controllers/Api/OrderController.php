<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        $order = Order::create([
            'restaurant_id' => $request->restaurant_id,
            'user_id' => $request->user()->id,
            'status' => 'pending',
        ]);

        foreach ($request->items as $item) {
            for ($i = 0; $i < $item['quantity']; $i++) {
                $order->dishes()->attach($item['dish_id']);
            }
        }

        return response()->json(['message' => 'Заказ успешно создан'], 200);
    }
}

