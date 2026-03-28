FROM php:8.1-apache

# 1. Cài đặt các thư viện hệ thống, Node.js và Supervisor
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    supervisor \
    curl \
    && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install mysqli pdo pdo_mysql zip

# 2. Cấu hình Apache
RUN a2enmod rewrite
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# 3. Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# 4. Copy toàn bộ code vào container
COPY . .

# 5. Cài đặt dependencies cho PHP (Composer)
RUN composer install --no-dev --optimize-autoloader

# 6. Cài đặt dependencies cho Node.js (Bridge)
RUN npm install

# 7. Phân quyền và chuẩn bị cho Supervisor
RUN chown -R www-data:www-data /var/www/html \
    && mkdir -p /var/log/supervisor

# 8. Copy cấu hình Supervisor
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# 9. Render sẽ dùng port 80 mặc định của Apache
EXPOSE 80

# 10. Chạy Supervisor để quản lý cả Apache và Node.js
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]