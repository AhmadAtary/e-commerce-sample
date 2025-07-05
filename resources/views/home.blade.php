@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="side-one">
        <div class="type">Ahmad Store</div>
        <h3>Premium</h3>
        <div class="big-thin">Quality Products</div>
        <div class="wrapper">
            <img class="spring" src="{{ asset('images/spring.png') }}" alt="Featured Product">
            <div class="small-bold">Best Selection</div>
            <div class="price">Starting from $99</div>
            <div class="buttons">
                <a href="{{ route('products.index') }}">
                    <button>Shop Now</button>
                </a>
                <button class="btn-outline">Learn More</button>
            </div>
        </div>
    </div>

    <div class="side-two">
        <div class="main-image">
            <img src="{{ asset('images/main.png') }}" alt="Ahmad Store">
        </div>
        <div class="small-images">
            <img src="{{ asset('images/image1.png') }}" alt="Product 1">
            <img src="{{ asset('images/image2.png') }}" alt="Product 2">
            <img src="{{ asset('images/image3.png') }}" alt="Product 3">
        </div>
    </div>
</div>

@if($featuredProducts->count() > 0)
<section class="featured-products" style="padding: 4rem 2rem; background-color: #2d3748;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h2 style="text-align: center; color: #d3b979; font-size: 2.5rem; margin-bottom: 3rem;">Featured Products</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem;">
            @foreach($featuredProducts as $product)
            <div style="background-color: #4a5568; border-radius: 10px; padding: 1.5rem; text-align: center; transition: transform 0.3s ease;">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px; margin-bottom: 1rem;">
                <h3 style="color: #fff; margin-bottom: 0.5rem;">{{ $product->name }}</h3>
                <p style="color: #a0aec0; margin-bottom: 1rem; font-size: 0.9rem;">{{ Str::limit($product->description, 100) }}</p>
                <div style="color: #d3b979; font-size: 1.2rem; font-weight: bold; margin-bottom: 1rem;">${{ number_format($product->price, 2) }}</div>
                <a href="{{ route('products.show', $product) }}" style="display: inline-block; background-color: #d3b979; color: #2d3748; padding: 0.75rem 1.5rem; border-radius: 5px; text-decoration: none; font-weight: bold; transition: background-color 0.3s ease;">
                    View Details
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<style>
.featured-products .product-card:hover {
    transform: translateY(-5px);
}

.alert {
    padding: 1rem;
    margin: 1rem 2rem;
    border-radius: 5px;
    font-weight: bold;
}

.alert-success {
    background-color: #48bb78;
    color: white;
}

.alert-error {
    background-color: #f56565;
    color: white;
}

.btn-outline {
    background: transparent;
    border: 2px solid #d3b979;
    color: #d3b979;
    padding: 0.75rem 1.5rem;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-outline:hover {
    background-color: #d3b979;
    color: #2d3748;
}

.cart-count {
    position: absolute;
    top: -8px;
    right: -8px;
    background-color: #f56565;
    color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    font-size: 0.8rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

.icons a {
    position: relative;
    color: #fff;
    text-decoration: none;
    margin: 0 0.5rem;
}
</style>
@endsection

