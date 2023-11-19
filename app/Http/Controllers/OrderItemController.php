<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public static function index()
    {
        $user=Auth::user();
        // return OrderItem::where('user_id', $user->id)->get()->load('product');
        return $user->orderItems()
            ->where('order_id', null)
            ->get()
            ->load('product.images');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
        if($product->stock <= 0) {
            abort(409, 'Product out of stock');
        }

        $product->stock = $product->stock - 1;
        $product->save();

        $user=Auth::user();
        return OrderItem::create([
            'product_id' => $product->id,
            'user_id' => $user->id,
            'order_id' => null
        ])->load('product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderItem $orderItem)
    {
        if($orderItem->order()->exists()) {
            abort(405, 'Cannot delete order item that is attached to an order');
        }

        $product = $orderItem->product()->first();
        $product->stock = $product->stock + 1;
        $product->save();

        $orderItem->delete();
        return OrderItemController::index();
    }
}
