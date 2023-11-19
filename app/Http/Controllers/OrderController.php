<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public static function index()
    {
        $user = Auth::user();
        return Order::latest()
            ->where('user_id', $user->id)
            ->get()
            ->load(['user', 'orderItems.product.images']);  
    }

    public function checkout() 
    {
        $user=Auth::user();
        $cart = $user->orderItems()
            ->where('order_id', null)
            ->get();

        if($cart->count() == 0) {
            abort(409, 'Cannot checkout an empty cart');
        }

        $charity = CharityController::index();

        $order = Order::create([
            'user_id' => $user->id,
            'total' => 0,
            'charity_id' => $charity->id
        ]);

        $cart->each(function ($item) use (&$order) {
            $order->total += $item->product->price;
            $order->save();

            $item->order_id = $order->id;
            $item->save();
        });

        $donation = $order->total * ($charity->donation_percentage / 100);
        $order->donation = $donation;
        $order->save();
    }
}
