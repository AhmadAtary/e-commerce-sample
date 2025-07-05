@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div style="padding: 2rem; background-color: #393d32; min-height: 80vh;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: start;">
            <!-- Product Image -->
            <div style="text-align: center;">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="width: 100%; max-width: 500px; height: 400px; object-fit: cover; border-radius: 10px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);">
            </div>
            
            <!-- Product Details -->
            <div style="color: #fff;">
                <h1 style="color: #d3b979; font-size: 2.5rem; margin-bottom: 1rem;">{{ $product->name }}</h1>
                
                <div style="font-size: 2rem; color: #d3b979; font-weight: bold; margin-bottom: 1.5rem;">
                    ${{ number_format($product->price, 2) }}
                </div>
                
                <div style="margin-bottom: 2rem;">
                    @if($product->stock > 0)
                        <span style="color: #48bb78; font-weight: bold;">✓ {{ $product->stock }} in stock</span>
                    @else
                        <span style="color: #f56565; font-weight: bold;">✗ Out of stock</span>
                    @endif
                </div>
                
                <div style="margin-bottom: 2rem; line-height: 1.6; color: #a0aec0;">
                    <h3 style="color: #fff; margin-bottom: 1rem;">Description</h3>
                    <p>{{ $product->description }}</p>
                </div>
                
                @auth
                    @if($product->stock > 0)
                    <form action="{{ route('cart.add', $product) }}" method="POST" style="margin-bottom: 2rem;">
                        @csrf
                        <div style="display: flex; gap: 1rem; align-items: center; margin-bottom: 1.5rem;">
                            <label for="quantity" style="color: #fff; font-weight: bold;">Quantity:</label>
                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" style="padding: 0.5rem; border-radius: 5px; border: none; width: 80px; text-align: center;">
                        </div>
                        
                        <div style="display: flex; gap: 1rem;">
                            <button type="submit" style="background-color: #d3b979; color: #2d3748; padding: 1rem 2rem; border: none; border-radius: 5px; font-weight: bold; font-size: 1.1rem; cursor: pointer; transition: background-color 0.3s ease;">
                                <i class="fa-solid fa-cart-plus"></i> Add to Cart
                            </button>
                            
                            <button type="button" style="background-color: transparent; color: #d3b979; padding: 1rem 2rem; border: 2px solid #d3b979; border-radius: 5px; font-weight: bold; font-size: 1.1rem; cursor: pointer; transition: all 0.3s ease;" onclick="addToWishlist()">
                                <i class="fa-regular fa-heart"></i> Add to Wishlist
                            </button>
                        </div>
                    </form>
                    @else
                    <div style="padding: 1rem; background-color: #f56565; color: white; border-radius: 5px; text-align: center; font-weight: bold;">
                        This product is currently out of stock
                    </div>
                    @endif
                @else
                <div style="padding: 1.5rem; background-color: #4a5568; border-radius: 10px; text-align: center;">
                    <p style="margin-bottom: 1rem; color: #a0aec0;">Please login to purchase this product</p>
                    <div style="display: flex; gap: 1rem; justify-content: center;">
                        <a href="{{ route('login') }}" style="background-color: #d3b979; color: #2d3748; padding: 0.75rem 1.5rem; border-radius: 5px; text-decoration: none; font-weight: bold;">
                            Login
                        </a>
                        <a href="{{ route('register') }}" style="background-color: transparent; color: #d3b979; padding: 0.75rem 1.5rem; border: 2px solid #d3b979; border-radius: 5px; text-decoration: none; font-weight: bold;">
                            Register
                        </a>
                    </div>
                </div>
                @endauth
                
                <div style="margin-top: 2rem;">
                    <a href="{{ route('products.index') }}" style="color: #d3b979; text-decoration: none; font-weight: bold;">
                        <i class="fa-solid fa-arrow-left"></i> Back to Products
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
button:hover {
    background-color: #b8860b !important;
}

button[onclick]:hover {
    background-color: #d3b979 !important;
    color: #2d3748 !important;
}

@media (max-width: 768px) {
    .product-detail-grid {
        grid-template-columns: 1fr !important;
        gap: 2rem !important;
    }
}
</style>

<script>
function addToWishlist() {
    alert('Wishlist functionality coming soon!');
}
</script>
@endsection

