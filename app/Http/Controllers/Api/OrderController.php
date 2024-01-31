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

        return response()->json([
            'message' => 'Заказ успешно создан',
            ], 200);
    }

    public function getUserOrders(Request $request)
    {
        $user = $request->user();
        $orders = Order::where('user_id', $user->id)->with('dishes.restaurant')->get();
        return response()->json([
            'orders' => $orders,
        ], 200);
    }

    public function getRestaurantOrders($restaurant_id)
    {
        $orders = Order::where('restaurant_id', $restaurant_id)->with('dishes.restaurant')->get();

        return response()->json([
            'orders' => $orders,
        ]);
    }

    public function updateOrderStatus(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        $order->status = $request->input('status');
        $order->save();

        return response()->json(['message' => 'Статус заказа успешно обновлен'], 200);
    }
}

