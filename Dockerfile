FROM php:8.2-apache

# Update dan install system dependencies yang dibutuhkan Laravel
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

# Bersihkan cache apt
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Ekstensi PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set direktori kerja
WORKDIR /var/www/html

# Salin semua file dari project lokal ke dalam container
COPY . /var/www/html

# Install dependencies backend (vendor)
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Install dependencies frontend (node_modules) dan jalankan build (Vite/Mix)
RUN npm install
RUN npm run build

# Mengubah konfigurasi Apache agar membaca folder 'public' (bukan root folder)
RUN sed -i -e 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Mengaktifkan mod_rewrite Apache (wajib untuk routing Laravel)
RUN a2enmod rewrite

# Memberikan hak akses read/write pada folder storage dan bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Buka port 80 (Render menggunakan port dinamis yang akan di-map ke port ini)
EXPOSE 80

# Jalankan server Apache saat container di-start
CMD ["apache2-foreground"]
