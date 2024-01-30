<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        $order = new Order();
        $order->restaurant_id = $request->order['restaurant_id'];
        $order->user_id = $request->user()->id;
        $order->status = 'pending';
        $order->save();

        foreach ($request->order['items'] as $item) {
            $quantity = $item['quantity'];
            $dish_id = $item['dish_id'];

            for ($i = 0; $i < $quantity; $i++) {
                $order->dishes()->attach($dish_id);
            }
        }

        return response()->json(['message' => 'Заказ успешно создан'], 201);
    }

}
