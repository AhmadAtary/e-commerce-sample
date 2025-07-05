<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Premium Wireless Headphones',
                'description' => 'High-quality wireless headphones with noise cancellation technology. Perfect for music lovers and professionals who demand crystal clear audio quality.',
                'price' => 299.99,
                'stock' => 50,
                'is_active' => true,
                'image_path' => 'images/product1.png',
            ],
            [
                'name' => 'Smart Fitness Watch',
                'description' => 'Advanced fitness tracking watch with heart rate monitoring, GPS, and smartphone connectivity. Track your workouts and stay connected.',
                'price' => 199.99,
                'stock' => 30,
                'is_active' => true,
                'image_path' => 'images/product2.png',
            ],
            [
                'name' => 'Portable Bluetooth Speaker',
                'description' => 'Compact and powerful Bluetooth speaker with 360-degree sound. Waterproof design perfect for outdoor adventures.',
                'price' => 89.99,
                'stock' => 75,
                'is_active' => true,
                'image_path' => 'images/product3.png',
            ],
            [
                'name' => 'Wireless Charging Pad',
                'description' => 'Fast wireless charging pad compatible with all Qi-enabled devices. Sleek design that complements any workspace.',
                'price' => 49.99,
                'stock' => 100,
                'is_active' => true,
                'image_path' => 'images/product4.png',
            ],
            [
                'name' => 'USB-C Hub',
                'description' => 'Multi-port USB-C hub with HDMI, USB 3.0, and SD card slots. Essential for modern laptops and tablets.',
                'price' => 79.99,
                'stock' => 60,
                'is_active' => true,
                'image_path' => 'images/product5.png',
            ],
            [
                'name' => 'Ergonomic Wireless Mouse',
                'description' => 'Comfortable wireless mouse designed for long hours of use. Precision tracking and customizable buttons.',
                'price' => 39.99,
                'stock' => 80,
                'is_active' => true,
                'image_path' => 'images/product6.png',
            ],
            [
                'name' => 'Mechanical Keyboard',
                'description' => 'Premium mechanical keyboard with RGB backlighting and tactile switches. Perfect for gaming and typing.',
                'price' => 149.99,
                'stock' => 25,
                'is_active' => true,
                'image_path' => 'images/product7.png',
            ],
            [
                'name' => 'Smartphone Camera Lens Kit',
                'description' => 'Professional camera lens kit for smartphones including wide-angle, macro, and telephoto lenses.',
                'price' => 69.99,
                'stock' => 40,
                'is_active' => true,
                'image_path' => 'images/product8.png',
            ],
            [
                'name' => 'Portable Power Bank',
                'description' => 'High-capacity power bank with fast charging technology. Keep your devices powered on the go.',
                'price' => 59.99,
                'stock' => 90,
                'is_active' => true,
                'image_path' => 'images/product9.png',
            ],
            [
                'name' => 'Smart Home Security Camera',
                'description' => 'WiFi-enabled security camera with night vision and motion detection. Monitor your home from anywhere.',
                'price' => 129.99,
                'stock' => 35,
                'is_active' => true,
                'image_path' => 'images/product10.png',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}


