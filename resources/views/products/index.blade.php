@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div style="padding: 2rem; background-color: #393d32; min-height: 80vh;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h1 style="text-align: center; color: #d3b979; font-size: 3rem; margin-bottom: 3rem;">Our Products</h1>
        
        @if($products->count() > 0)
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-bottom: 3rem;">
            @foreach($products as $product)
            <div style="background-color: #4a5568; border-radius: 10px; padding: 1.5rem; text-align: center; transition: transform 0.3s ease, box-shadow 0.3s ease;" class="product-card">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="width: 100%; height: 250px; object-fit: cover; border-radius: 8px; margin-bottom: 1rem;">
                <h3 style="color: #fff; margin-bottom: 0.5rem; font-size: 1.3rem;">{{ $product->name }}</h3>
                <p style="color: #a0aec0; margin-bottom: 1rem; font-size: 0.9rem; line-height: 1.4;">{{ Str::limit($product->description, 120) }}</p>
                <div style="color: #d3b979; font-size: 1.4rem; font-weight: bold; margin-bottom: 1rem;">${{ number_format($product->price, 2) }}</div>
                
                @if($product->stock > 0)
                    <div style="color: #48bb78; margin-bottom: 1rem; font-size: 0.9rem;">{{ $product->stock }} in stock</div>
                @else
                    <div style="color: #f56565; margin-bottom: 1rem; font-size: 0.9rem;">Out of stock</div>
                @endif
                
                <div style="display: flex; gap: 1rem; justify-content: center;">
                    <a href="{{ route('products.show', $product) }}" style="background-color: #d3b979; color: #2d3748; padding: 0.75rem 1.5rem; border-radius: 5px; text-decoration: none; font-weight: bold; transition: background-color 0.3s ease;">
                        View Details
                    </a>
                    
                    @auth
                        @if($product->stock > 0)
                        <form action="{{ route('cart.add', $product) }}" method="POST" style="display: inline;">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" style="background-color: #48bb78; color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; transition: background-color 0.3s ease;">
                                Add to Cart
                            </button>
                        </form>
                        @endif
                    @else
                        <a href="{{ route('login') }}" style="background-color: #48bb78; color: white; padding: 0.75rem 1.5rem; border-radius: 5px; text-decoration: none; font-weight: bold;">
                            Login to Buy
                        </a>
                    @endauth
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div style="display: flex; justify-content: center;">
            {{ $products->links() }}
        </div>
        @else
        <div style="text-align: center; color: #a0aec0; font-size: 1.2rem; margin-top: 4rem;">
            <i class="fa-solid fa-box-open" style="font-size: 4rem; margin-bottom: 1rem; color: #4a5568;"></i>
            <p>No products available at the moment.</p>
            <p>Please check back later!</p>
        </div>
        @endif
    </div>
</div>

<style>
.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
}

.product-card button:hover {
    background-color: #38a169 !important;
}

.product-card a:hover {
    background-color: #b8860b !important;
}

/* Pagination styling */
.pagination {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    margin-top: 2rem;
}

.pagination a, .pagination span {
    padding: 0.5rem 1rem;
    background-color: #4a5568;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.pagination a:hover {
    background-color: #d3b979;
    color: #2d3748;
}

.pagination .current {
    background-color: #d3b979;
    color: #2d3748;
}
</style>
@endsection

