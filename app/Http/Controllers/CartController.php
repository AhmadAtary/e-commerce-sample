<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display the cart contents.
     */
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    /**
     * Add a product to the cart.
     */
    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $existingCartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($existingCartItem) {
            $existingCartItem->quantity += $request->quantity;
            $existingCartItem->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }

    /**
     * Update the quantity of a cart item.
     */
    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Ensure the cart item belongs to the authenticated user
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cart->update(['quantity' => $request->quantity]);

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
    }

    /**
     * Remove a product from the cart.
     */
    public function remove(Cart $cart)
    {
        // Ensure the cart item belongs to the authenticated user
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Product removed from cart.');
    }

    /**
     * Clear all items from the cart.
     */
    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully.');
    }

    /**
     * Get cart count for display in navigation.
     */
    public function count()
    {
        if (Auth::check()) {
            return Cart::where('user_id', Auth::id())->sum('quantity');
        }
        return 0;
    }
}

