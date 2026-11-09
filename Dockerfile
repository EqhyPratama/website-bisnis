# Stage 1: Build aset frontend (Tailwind CSS & Vite)
FROM node:20-alpine AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2: Setup PHP 8.3 & Laravel 11
FROM php:8.3-cli-alpine
WORKDIR /var/www/html

# Install dependency sistem untuk SQLite & ekstensi PHP
RUN apk add --no-cache \
    libzip-dev \
    zip \
    unzip \
    sqlite \
    sqlite-dev \
    oniguruma-dev \
    && docker-php-ext-install pdo pdo_sqlite mbstring zip bcmath

# Ambil binary Composer resmi
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Salin seluruh kode aplikasi
COPY . .

# Salin hasil build Tailwind/Vite dari Stage 1
COPY --from=frontend /app/public/build ./public/build

# Nonaktifkan pemblokir security advisory Composer & install paket production
RUN composer config policy.advisories.block false \
    && composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Siapkan environment (.env), database SQLite, dan permission folder
RUN cp .env.example .env \
    && sed -i 's/SESSION_DRIVER=database/SESSION_DRIVER=file/g' .env \
    && touch database/database.sqlite \
    && php artisan key:generate --force \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

EXPOSE 8000

# Jalankan migrasi & nyalakan server pada port 8000
CMD ["sh", "-c", "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000"]
