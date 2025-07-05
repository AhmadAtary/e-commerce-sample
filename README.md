# Ahmad E-Commerce Store

A modern, responsive e-commerce web application built with Laravel, featuring a clean UI design and comprehensive shopping functionality.

## 🚀 Features

### Core Functionality
- **User Authentication**: Secure registration and login system using Laravel Breeze
- **Product Catalog**: Browse products with detailed information, pricing, and stock levels
- **Shopping Cart**: Add, update, and remove items from cart
- **Checkout Process**: Complete order placement with shipping and billing information
- **Order Management**: View order history and track order status
- **Responsive Design**: Optimized for desktop, tablet, and mobile devices

### Technical Features
- **Laravel Framework**: Built on Laravel 10 with modern PHP practices
- **SQLite Database**: Lightweight database for easy deployment
- **Blade Templates**: Server-side rendering with reusable components
- **Asset Management**: Vite for modern asset compilation
- **Security**: CSRF protection, secure authentication, and input validation

## 🎨 Design

The application features a modern dark theme with golden accents, inspired by premium e-commerce experiences:

- **Brand Identity**: "Ahmad" branding throughout the application
- **Color Scheme**: Dark background (#393d32) with golden highlights (#d3b979)
- **Typography**: Clean, readable fonts with proper hierarchy
- **Responsive Layout**: Mobile-first design approach
- **User Experience**: Intuitive navigation and smooth interactions

## 📱 Screenshots

### Home Page
- Hero section with featured products
- Product showcase with pricing and descriptions
- Call-to-action buttons for shopping

### Product Catalog
- Grid layout with product cards
- Stock information and pricing
- Quick add to cart functionality

### Shopping Cart
- Item management with quantity updates
- Order summary with tax calculations
- Secure checkout process

## 🛠️ Installation

### Prerequisites
- PHP 8.1 or higher
- Composer
- Node.js and npm
- SQLite

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/ahmad-ecommerce.git
   cd ahmad-ecommerce
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database setup**
   ```bash
   touch database/database.sqlite
   php artisan migrate
   php artisan db:seed --class=ProductSeeder
   ```

6. **Build assets**
   ```bash
   npm run build
   ```

7. **Start the development server**
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` to view the application.

## 📁 Project Structure

```
ahmad-ecommerce/
├── app/
│   ├── Http/Controllers/
│   │   ├── CartController.php
│   │   ├── OrderController.php
│   │   └── ProductController.php
│   └── Models/
│       ├── Cart.php
│       ├── Order.php
│       ├── OrderItem.php
│       └── Product.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
│       ├── cart/
│       ├── checkout/
│       ├── orders/
│       ├── products/
│       └── layouts/
├── public/
│   ├── css/
│   ├── js/
│   └── images/
└── routes/
    └── web.php
```

## 🔧 Configuration

### Database
The application uses SQLite by default for easy setup. To use MySQL or PostgreSQL:

1. Update the `.env` file with your database credentials
2. Run migrations: `php artisan migrate`
3. Seed the database: `php artisan db:seed`

### Email Configuration
For order confirmations and notifications, configure your email settings in the `.env` file:

```env
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-password
```

## 🚀 Deployment

### Production Deployment

1. **Server Requirements**
   - PHP 8.1+
   - Composer
   - Web server (Apache/Nginx)
   - Database (MySQL/PostgreSQL/SQLite)

2. **Deployment Steps**
   ```bash
   # Clone and setup
   git clone https://github.com/your-username/ahmad-ecommerce.git
   cd ahmad-ecommerce
   composer install --optimize-autoloader --no-dev
   
   # Environment
   cp .env.example .env
   php artisan key:generate
   
   # Database
   php artisan migrate --force
   php artisan db:seed --force
   
   # Assets
   npm install
   npm run build
   
   # Permissions
   chmod -R 755 storage bootstrap/cache
   ```

3. **Web Server Configuration**
   Point your web server document root to the `public` directory.

## 🛡️ Security

- CSRF protection on all forms
- Input validation and sanitization
- Secure password hashing
- SQL injection prevention through Eloquent ORM
- XSS protection through Blade templating

## 🧪 Testing

Run the test suite:
```bash
php artisan test
```

## 📝 API Documentation

The application includes RESTful routes for:
- Product management
- Cart operations
- Order processing
- User authentication

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

## 👨‍💻 Developer

**Developed by Ahmad Afsheh**

This project was created as a portfolio demonstration of modern e-commerce development using Laravel and responsive web design principles.

## 🙏 Acknowledgments

- Laravel Framework for the robust backend foundation
- Laravel Breeze for authentication scaffolding
- Font Awesome for icons
- Original UI inspiration from open-source e-commerce designs

## 📞 Support

For support, email support@ahmad-store.com or create an issue in the GitHub repository.

---

*Built with ❤️ using Laravel and modern web technologies*

