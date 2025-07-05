@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div style="padding: 2rem; background-color: #393d32; min-height: 80vh;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h1 style="text-align: center; color: #d3b979; font-size: 3rem; margin-bottom: 3rem;">Shopping Cart</h1>
        
        @if($cartItems->count() > 0)
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 3rem;">
            <!-- Cart Items -->
            <div>
                @foreach($cartItems as $item)
                <div style="background-color: #4a5568; border-radius: 10px; padding: 1.5rem; margin-bottom: 1.5rem; display: flex; gap: 1.5rem; align-items: center;">
                    <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                    
                    <div style="flex: 1;">
                        <h3 style="color: #fff; margin-bottom: 0.5rem;">{{ $item->product->name }}</h3>
                        <p style="color: #a0aec0; margin-bottom: 0.5rem;">{{ Str::limit($item->product->description, 100) }}</p>
                        <div style="color: #d3b979; font-weight: bold; font-size: 1.2rem;">${{ number_format($item->product->price, 2) }} each</div>
                    </div>
                    
                    <div style="display: flex; flex-direction: column; gap: 1rem; align-items: center;">
                        <form action="{{ route('cart.update', $item) }}" method="POST" style="display: flex; align-items: center; gap: 0.5rem;">
                            @csrf
                            @method('PATCH')
                            <label style="color: #fff; font-size: 0.9rem;">Qty:</label>
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" style="width: 60px; padding: 0.25rem; border-radius: 3px; border: none; text-align: center;">
                            <button type="submit" style="background-color: #d3b979; color: #2d3748; padding: 0.25rem 0.5rem; border: none; border-radius: 3px; font-size: 0.8rem; cursor: pointer;">
                                Update
                            </button>
                        </form>
                        
                        <form action="{{ route('cart.remove', $item) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background-color: #f56565; color: white; padding: 0.5rem 1rem; border: none; border-radius: 5px; font-size: 0.9rem; cursor: pointer;" onclick="return confirm('Remove this item from cart?')">
                                <i class="fa-solid fa-trash"></i> Remove
                            </button>
                        </form>
                        
                        <div style="color: #d3b979; font-weight: bold; text-align: center;">
                            Total: ${{ number_format($item->quantity * $item->product->price, 2) }}
                        </div>
                    </div>
                </div>
                @endforeach
                
                <div style="text-align: center; margin-top: 2rem;">
                    <form action="{{ route('cart.clear') }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background-color: #f56565; color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 5px; font-weight: bold; cursor: pointer;" onclick="return confirm('Clear entire cart?')">
                            <i class="fa-solid fa-trash-can"></i> Clear Cart
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Cart Summary -->
            <div style="background-color: #4a5568; border-radius: 10px; padding: 2rem; height: fit-content;">
                <h3 style="color: #d3b979; font-size: 1.5rem; margin-bottom: 1.5rem; text-align: center;">Order Summary</h3>
                
                <div style="border-bottom: 1px solid #6b7280; padding-bottom: 1rem; margin-bottom: 1rem;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; color: #a0aec0;">
                        <span>Subtotal ({{ $cartItems->sum('quantity') }} items):</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; color: #a0aec0;">
                        <span>Shipping:</span>
                        <span>Free</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; color: #a0aec0;">
                        <span>Tax:</span>
                        <span>${{ number_format($total * 0.08, 2) }}</span>
                    </div>
                </div>
                
                <div style="display: flex; justify-content: space-between; font-size: 1.3rem; font-weight: bold; color: #d3b979; margin-bottom: 2rem;">
                    <span>Total:</span>
                    <span>${{ number_format($total * 1.08, 2) }}</span>
                </div>
                
                <a href="{{ route('checkout.index') }}" style="display: block; background-color: #d3b979; color: #2d3748; padding: 1rem; border-radius: 5px; text-decoration: none; font-weight: bold; text-align: center; font-size: 1.1rem; transition: background-color 0.3s ease;">
                    <i class="fa-solid fa-credit-card"></i> Proceed to Checkout
                </a>
                
                <a href="{{ route('products.index') }}" style="display: block; background-color: transparent; color: #d3b979; padding: 1rem; border: 2px solid #d3b979; border-radius: 5px; text-decoration: none; font-weight: bold; text-align: center; margin-top: 1rem; transition: all 0.3s ease;">
                    <i class="fa-solid fa-arrow-left"></i> Continue Shopping
                </a>
            </div>
        </div>
        @else
        <div style="text-align: center; color: #a0aec0; margin-top: 4rem;">
            <i class="fa-solid fa-cart-shopping" style="font-size: 4rem; margin-bottom: 1rem; color: #4a5568;"></i>
            <h2 style="color: #fff; margin-bottom: 1rem;">Your cart is empty</h2>
            <p style="margin-bottom: 2rem;">Looks like you haven't added any items to your cart yet.</p>
            <a href="{{ route('products.index') }}" style="background-color: #d3b979; color: #2d3748; padding: 1rem 2rem; border-radius: 5px; text-decoration: none; font-weight: bold; font-size: 1.1rem;">
                <i class="fa-solid fa-shopping-bag"></i> Start Shopping
            </a>
        </div>
        @endif
    </div>
</div>

<style>
button:hover, a:hover {
    opacity: 0.9;
}

@media (max-width: 768px) {
    .cart-grid {
        grid-template-columns: 1fr !important;
    }
    
    .cart-item {
        flex-direction: column !important;
        text-align: center;
    }
}
</style>
@endsection

