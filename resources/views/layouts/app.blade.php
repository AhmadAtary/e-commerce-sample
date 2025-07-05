<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ahmad') }} - @yield('title', 'E-Commerce Store')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/ecommerce.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Custom styles for Ahmad branding */
        .logo .name {
            font-weight: bold;
            font-size: 1.5rem;
        }
        
        .footer {
            background-color: #2d3748;
            color: #fff;
            padding: 2rem 0;
            margin-top: 4rem;
        }
        
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            text-align: center;
        }
        
        .footer-brand {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #d3b979;
        }
        
        .footer-text {
            margin-bottom: 0.5rem;
        }
        
        .developer-credit {
            font-size: 0.9rem;
            color: #a0aec0;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #4a5568;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .nav-bar {
                margin: 1rem;
            }
            
            .container {
                padding: 1rem;
            }
        }
    </style>
</head>

<body>
    <header>
        <nav class="nav-bar">
            <div class="logo">
                <div class="name">Ahmad</div>
                <i class="fa-solid fa-basket-shopping"></i>
            </div>
            <div class="bars">
                <i class="fa-solid fa-bars"></i>
            </div>

            <div class="nav-menu">
                <ul class="nav-items">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('products.index') }}">Products</a></li>
                    @auth
                        <li><a href="{{ route('orders.index') }}">My Orders</a></li>
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    @endauth
                    @guest
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @endguest
                </ul>
            </div>

            <div class="icons">
                @auth
                    <a href="{{ route('cart.index') }}">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="cart-count" id="cart-count">0</span>
                    </a>
                    <i class="fa-regular fa-heart"></i>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: #fff; cursor: pointer;">
                            <i class="fa-solid fa-sign-out-alt"></i>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}">
                        <i class="fa-solid fa-user"></i>
                    </a>
                @endauth
            </div>
        </nav>
    </header>

    <main>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-brand">Ahmad</div>
            <div class="footer-text">Your trusted e-commerce destination</div>
            <div class="footer-text">Quality products, exceptional service</div>
            <div class="developer-credit">
                Developed by Ahmad Afsheh
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/ecommerce.js') }}"></script>
    @stack('scripts')
</body>
</html>

