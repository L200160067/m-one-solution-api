# Menggunakan base image PHP 8.3 Apache resmi
FROM php:8.3-apache

# Menginstall ekstensi OS yang dibutuhkan Laravel & Filament
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    libpq-dev \
    libicu-dev

# Konfigurasi dan install Ekstensi PHP yang wajib
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip exif pcntl gd intl

# Aktifkan mod_rewrite Apache supaya routing Laravel (tanpa index.php) jalan
RUN a2enmod rewrite

# Mengubah pengaturan root dokumen Apache (VirtualHost) langsung mengarah ke folder public Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Download dan install Composer (Package manager PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js dan NPM langsung (Sangat penting untuk Filament v3 build assets)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Pindah ke direktori kerja container
WORKDIR /var/www/html

# Salin semua isi file project Anda ke dalam container
COPY . /var/www/html/

# Ubah perizinan folder penyimpanan (supaya laravel bisa nulis cache/log)
RUN chown -R www-data:www-data /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Jalankan Composer
RUN composer install --no-dev --optimize-autoloader

# Jalankan NPM Build (Untuk compiling CSS/JS backend/filament)
RUN npm install \
    && npm run build

# Port Default Apache (opsional, tapi disarankan)
EXPOSE 80

# Tidak butuh CMD karena bawaan image php:8.3-apache sudah menjalankan "apache2-foreground" otomatis
