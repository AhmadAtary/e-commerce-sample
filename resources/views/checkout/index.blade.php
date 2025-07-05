@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div style="padding: 2rem; background-color: #393d32; min-height: 80vh;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h1 style="text-align: center; color: #d3b979; font-size: 3rem; margin-bottom: 3rem;">Checkout</h1>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem;">
            <!-- Checkout Form -->
            <div style="background-color: #4a5568; border-radius: 10px; padding: 2rem;">
                <h2 style="color: #d3b979; margin-bottom: 2rem;">Shipping Information</h2>
                
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    
                    <div style="margin-bottom: 1.5rem;">
                        <label for="shipping_address" style="display: block; color: #fff; margin-bottom: 0.5rem; font-weight: bold;">Shipping Address *</label>
                        <textarea name="shipping_address" id="shipping_address" rows="4" required style="width: 100%; padding: 0.75rem; border-radius: 5px; border: none; resize: vertical;" placeholder="Enter your complete shipping address...">{{ old('shipping_address') }}</textarea>
                        @error('shipping_address')
                            <div style="color: #f56565; font-size: 0.9rem; margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <label for="billing_address" style="display: block; color: #fff; margin-bottom: 0.5rem; font-weight: bold;">Billing Address *</label>
                        <textarea name="billing_address" id="billing_address" rows="4" required style="width: 100%; padding: 0.75rem; border-radius: 5px; border: none; resize: vertical;" placeholder="Enter your complete billing address...">{{ old('billing_address') }}</textarea>
                        @error('billing_address')
                            <div style="color: #f56565; font-size: 0.9rem; margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: flex; align-items: center; color: #fff; cursor: pointer;">
                            <input type="checkbox" id="same_address" style="margin-right: 0.5rem;" onchange="copyShippingToBilling()">
                            Billing address is the same as shipping address
                        </label>
                    </div>
                    
                    <h3 style="color: #d3b979; margin: 2rem 0 1rem;">Payment Method</h3>
                    <div style="background-color: #6b7280; padding: 1rem; border-radius: 5px; margin-bottom: 2rem;">
                        <p style="color: #fff; margin-bottom: 0.5rem;"><i class="fa-solid fa-info-circle"></i> Payment Processing</p>
                        <p style="color: #a0aec0; font-size: 0.9rem;">This is a demo application. No actual payment will be processed.</p>
                    </div>
                    
                    <button type="submit" style="width: 100%; background-color: #d3b979; color: #2d3748; padding: 1rem; border: none; border-radius: 5px; font-weight: bold; font-size: 1.1rem; cursor: pointer; transition: background-color 0.3s ease;">
                        <i class="fa-solid fa-lock"></i> Place Order
                    </button>
                </form>
            </div>
            
            <!-- Order Summary -->
            <div style="background-color: #4a5568; border-radius: 10px; padding: 2rem; height: fit-content;">
                <h2 style="color: #d3b979; margin-bottom: 2rem;">Order Summary</h2>
                
                @foreach($cartItems as $item)
                <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 1px solid #6b7280;">
                    <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                    <div style="flex: 1;">
                        <h4 style="color: #fff; margin-bottom: 0.25rem;">{{ $item->product->name }}</h4>
                        <p style="color: #a0aec0; font-size: 0.9rem;">Qty: {{ $item->quantity }}</p>
                        <p style="color: #d3b979; font-weight: bold;">${{ number_format($item->product->price * $item->quantity, 2) }}</p>
                    </div>
                </div>
                @endforeach
                
                <div style="border-top: 2px solid #6b7280; padding-top: 1rem; margin-top: 1rem;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; color: #a0aec0;">
                        <span>Subtotal:</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; color: #a0aec0;">
                        <span>Shipping:</span>
                        <span>Free</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; color: #a0aec0;">
                        <span>Tax (8%):</span>
                        <span>${{ number_format($total * 0.08, 2) }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; font-size: 1.3rem; font-weight: bold; color: #d3b979;">
                        <span>Total:</span>
                        <span>${{ number_format($total * 1.08, 2) }}</span>
                    </div>
                </div>
                
                <div style="margin-top: 2rem; padding: 1rem; background-color: #6b7280; border-radius: 5px;">
                    <p style="color: #fff; font-size: 0.9rem; margin-bottom: 0.5rem;"><i class="fa-solid fa-shield-alt"></i> Secure Checkout</p>
                    <p style="color: #a0aec0; font-size: 0.8rem;">Your information is protected with 256-bit SSL encryption.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyShippingToBilling() {
    const checkbox = document.getElementById('same_address');
    const shippingAddress = document.getElementById('shipping_address');
    const billingAddress = document.getElementById('billing_address');
    
    if (checkbox.checked) {
        billingAddress.value = shippingAddress.value;
        billingAddress.readOnly = true;
        billingAddress.style.backgroundColor = '#e2e8f0';
    } else {
        billingAddress.readOnly = false;
        billingAddress.style.backgroundColor = 'white';
    }
}

// Copy shipping to billing when shipping address changes and checkbox is checked
document.getElementById('shipping_address').addEventListener('input', function() {
    const checkbox = document.getElementById('same_address');
    if (checkbox.checked) {
        document.getElementById('billing_address').value = this.value;
    }
});
</script>

<style>
button:hover {
    background-color: #b8860b !important;
}

@media (max-width: 768px) {
    .checkout-grid {
        grid-template-columns: 1fr !important;
    }
}
</style>
@endsection

