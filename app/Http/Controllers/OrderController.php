<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display the checkout form.
     */
    public function checkout()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return view('checkout.index', compact('cartItems', 'total'));
    }

    /**
     * Process the order.
     */
    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:500',
            'billing_address' => 'required|string|max:500',
        ]);

        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        DB::transaction(function () use ($request, $cartItems, $total) {
            // Create the order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $total,
                'shipping_address' => $request->shipping_address,
                'billing_address' => $request->billing_address,
                'status' => 'pending',
            ]);

            // Create order items
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                ]);

                // Update product stock
                $cartItem->product->decrement('stock', $cartItem->quantity);
            }

            // Clear the cart
            Cart::where('user_id', Auth::id())->delete();
        });

        return redirect()->route('orders.success')->with('success', 'Order placed successfully!');
    }

    /**
     * Display order success page.
     */
    public function success()
    {
        return view('checkout.success');
    }

    /**
     * Display user's orders.
     */
    public function index()
    {
        $orders = Order::with('orderItems.product')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * Display a specific order.
     */
    public function show(Order $order)
    {
        // Ensure the order belongs to the authenticated user
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('orderItems.product');

        return view('orders.show', compact('order'));
    }
}

