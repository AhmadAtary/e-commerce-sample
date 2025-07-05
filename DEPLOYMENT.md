# Deployment Guide - Ahmad E-Commerce Store

This guide provides step-by-step instructions for deploying the Ahmad E-Commerce Store to various hosting platforms.

## 🚀 Quick Deployment Options

### 1. Shared Hosting (cPanel)

**Requirements:**
- PHP 8.1+
- MySQL/MariaDB
- Composer access

**Steps:**
1. Upload files to public_html directory
2. Import database.sqlite or create MySQL database
3. Update .env file with production settings
4. Run composer install --optimize-autoloader --no-dev
5. Set proper file permissions (755 for directories, 644 for files)

### 2. VPS/Cloud Server (Ubuntu/CentOS)

**Requirements:**
- Ubuntu 20.04+ or CentOS 8+
- Nginx/Apache
- PHP 8.1+
- MySQL/PostgreSQL
- Composer
- Node.js

**Installation Script:**
```bash
#!/bin/bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install PHP and extensions
sudo apt install php8.1 php8.1-fpm php8.1-mysql php8.1-xml php8.1-mbstring php8.1-curl php8.1-zip -y

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Node.js
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt-get install -y nodejs

# Clone repository
git clone https://github.com/your-username/ahmad-ecommerce.git
cd ahmad-ecommerce

# Install dependencies
composer install --optimize-autoloader --no-dev
npm install && npm run build

# Setup environment
cp .env.example .env
php artisan key:generate

# Database setup
php artisan migrate --force
php artisan db:seed --force

# Set permissions
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 755 storage bootstrap/cache
```

### 3. Docker Deployment

**Dockerfile:**
```dockerfile
FROM php:8.1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy application files
COPY . .

# Install dependencies
RUN composer install --optimize-autoloader --no-dev
RUN npm install && npm run build

# Set permissions
RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
```

**docker-compose.yml:**
```yaml
version: '3.8'
services:
  app:
    build: .
    container_name: ahmad-ecommerce
    restart: unless-stopped
    working_dir: /var/www
    volumes:
      - ./:/var/www
    networks:
      - ahmad-network

  nginx:
    image: nginx:alpine
    container_name: ahmad-nginx
    restart: unless-stopped
    ports:
      - "80:80"
    volumes:
      - ./:/var/www
      - ./docker/nginx:/etc/nginx/conf.d
    networks:
      - ahmad-network

  db:
    image: mysql:8.0
    container_name: ahmad-db
    restart: unless-stopped
    environment:
      MYSQL_DATABASE: ahmad_ecommerce
      MYSQL_ROOT_PASSWORD: secret
      MYSQL_PASSWORD: secret
      MYSQL_USER: ahmad
    volumes:
      - dbdata:/var/lib/mysql
    networks:
      - ahmad-network

volumes:
  dbdata:

networks:
  ahmad-network:
    driver: bridge
```

### 4. Heroku Deployment

**Procfile:**
```
web: vendor/bin/heroku-php-apache2 public/
```

**Deployment Steps:**
```bash
# Install Heroku CLI
# Create Heroku app
heroku create ahmad-ecommerce-store

# Add buildpacks
heroku buildpacks:add heroku/php
heroku buildpacks:add heroku/nodejs

# Set environment variables
heroku config:set APP_KEY=$(php artisan --no-ansi key:generate --show)
heroku config:set APP_ENV=production
heroku config:set APP_DEBUG=false
heroku config:set APP_URL=https://ahmad-ecommerce-store.herokuapp.com

# Add database
heroku addons:create heroku-postgresql:hobby-dev

# Deploy
git push heroku main

# Run migrations
heroku run php artisan migrate --force
heroku run php artisan db:seed --force
```

### 5. DigitalOcean App Platform

**app.yaml:**
```yaml
name: ahmad-ecommerce
services:
- name: web
  source_dir: /
  github:
    repo: your-username/ahmad-ecommerce
    branch: main
  run_command: heroku-php-apache2 public/
  environment_slug: php
  instance_count: 1
  instance_size_slug: basic-xxs
  envs:
  - key: APP_ENV
    value: production
  - key: APP_DEBUG
    value: false
  - key: APP_KEY
    type: SECRET
    value: your-app-key
databases:
- name: db
  engine: PG
  version: "13"
  size: db-s-dev-database
```

## 🔧 Environment Configuration

### Production .env Template
```env
APP_NAME="Ahmad E-Commerce"
APP_ENV=production
APP_KEY=base64:your-generated-key
APP_DEBUG=false
APP_URL=https://your-domain.com

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_PORT=3306
DB_DATABASE=your-database
DB_USERNAME=your-username
DB_PASSWORD=your-password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@your-domain.com"
MAIL_FROM_NAME="${APP_NAME}"
```

## 🛡️ Security Checklist

### Pre-Deployment Security
- [ ] Update all dependencies to latest versions
- [ ] Set APP_DEBUG=false in production
- [ ] Use strong, unique APP_KEY
- [ ] Configure proper file permissions
- [ ] Enable HTTPS/SSL
- [ ] Set up database backups
- [ ] Configure rate limiting
- [ ] Enable CSRF protection
- [ ] Validate all user inputs
- [ ] Use environment variables for sensitive data

### Post-Deployment Security
- [ ] Monitor application logs
- [ ] Set up error tracking (Sentry, Bugsnag)
- [ ] Configure monitoring (New Relic, DataDog)
- [ ] Regular security updates
- [ ] Database backup verification
- [ ] SSL certificate renewal
- [ ] Performance monitoring

## 📊 Performance Optimization

### Laravel Optimizations
```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize autoloader
composer install --optimize-autoloader --no-dev

# Cache events
php artisan event:cache
```

### Web Server Configuration

**Nginx Configuration:**
```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /var/www/ahmad-ecommerce/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

## 🔄 CI/CD Pipeline

### GitHub Actions Workflow
```yaml
name: Deploy Ahmad E-Commerce

on:
  push:
    branches: [ main ]

jobs:
  deploy:
    runs-on: ubuntu-latest
    
    steps:
    - uses: actions/checkout@v2
    
    - name: Setup PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: '8.1'
        
    - name: Install dependencies
      run: composer install --optimize-autoloader --no-dev
      
    - name: Run tests
      run: php artisan test
      
    - name: Deploy to server
      uses: appleboy/ssh-action@v0.1.5
      with:
        host: ${{ secrets.HOST }}
        username: ${{ secrets.USERNAME }}
        key: ${{ secrets.KEY }}
        script: |
          cd /var/www/ahmad-ecommerce
          git pull origin main
          composer install --optimize-autoloader --no-dev
          php artisan migrate --force
          php artisan config:cache
          php artisan route:cache
          php artisan view:cache
```

## 📞 Support

For deployment assistance:
- Email: support@ahmad-store.com
- Documentation: [GitHub Wiki](https://github.com/your-username/ahmad-ecommerce/wiki)
- Issues: [GitHub Issues](https://github.com/your-username/ahmad-ecommerce/issues)

---

**Developed by Ahmad Afsheh** - Professional Laravel E-Commerce Solution

