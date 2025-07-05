@extends('layouts.app')

@section('title', 'Order Successful')

@section('content')
<div style="padding: 4rem 2rem; background-color: #393d32; min-height: 80vh; display: flex; align-items: center; justify-content: center;">
    <div style="max-width: 600px; text-align: center; background-color: #4a5568; border-radius: 15px; padding: 3rem; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);">
        <div style="margin-bottom: 2rem;">
            <i class="fa-solid fa-check-circle" style="font-size: 4rem; color: #48bb78; margin-bottom: 1rem;"></i>
        </div>
        
        <h1 style="color: #d3b979; font-size: 2.5rem; margin-bottom: 1rem;">Order Successful!</h1>
        
        <p style="color: #a0aec0; font-size: 1.1rem; margin-bottom: 2rem; line-height: 1.6;">
            Thank you for your purchase! Your order has been successfully placed and is being processed.
        </p>
        
        <div style="background-color: #6b7280; border-radius: 10px; padding: 1.5rem; margin-bottom: 2rem;">
            <h3 style="color: #fff; margin-bottom: 1rem;">What's Next?</h3>
            <ul style="color: #a0aec0; text-align: left; list-style: none; padding: 0;">
                <li style="margin-bottom: 0.5rem;"><i class="fa-solid fa-envelope" style="color: #d3b979; margin-right: 0.5rem;"></i> You'll receive an order confirmation email shortly</li>
                <li style="margin-bottom: 0.5rem;"><i class="fa-solid fa-truck" style="color: #d3b979; margin-right: 0.5rem;"></i> We'll notify you when your order ships</li>
                <li style="margin-bottom: 0.5rem;"><i class="fa-solid fa-clock" style="color: #d3b979; margin-right: 0.5rem;"></i> Expected delivery: 3-5 business days</li>
            </ul>
        </div>
        
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('orders.index') }}" style="background-color: #d3b979; color: #2d3748; padding: 1rem 2rem; border-radius: 5px; text-decoration: none; font-weight: bold; transition: background-color 0.3s ease;">
                <i class="fa-solid fa-list"></i> View My Orders
            </a>
            
            <a href="{{ route('products.index') }}" style="background-color: transparent; color: #d3b979; padding: 1rem 2rem; border: 2px solid #d3b979; border-radius: 5px; text-decoration: none; font-weight: bold; transition: all 0.3s ease;">
                <i class="fa-solid fa-shopping-bag"></i> Continue Shopping
            </a>
        </div>
        
        <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #6b7280;">
            <p style="color: #a0aec0; font-size: 0.9rem;">
                Need help? Contact our support team at 
                <a href="mailto:support@ahmad-store.com" style="color: #d3b979; text-decoration: none;">support@ahmad-store.com</a>
            </p>
        </div>
    </div>
</div>

<style>
a:hover {
    opacity: 0.9;
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .success-container {
        padding: 2rem 1rem !important;
    }
    
    .success-card {
        padding: 2rem !important;
    }
    
    .action-buttons {
        flex-direction: column !important;
    }
    
    .action-buttons a {
        width: 100%;
        text-align: center;
    }
}
</style>
@endsection

