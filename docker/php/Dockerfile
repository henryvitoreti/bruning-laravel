FROM php:8.2-fpm

# Instala dependências do sistema
RUN apt-get update
RUN apt-get install -y procps
RUN apt-get install -y git
RUN apt-get install -y curl
RUN apt-get install -y libpng-dev
RUN apt-get install -y libonig-dev
RUN apt-get install -y libxml2-dev
RUN apt-get install -y zip
RUN apt-get install -y unzip
RUN apt-get install -y nginx
RUN apt-get install -y net-tools

# Limpa o cache do apt
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instala extensões do PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd


# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www

# Copia o código da aplicação para o container
COPY . /var/www

# Configura as permissões do Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Instala as dependências do Laravel
RUN composer install --optimize-autoloader --no-dev --prefer-dist --no-progress --no-suggest

# Expõe a porta 9000 (PHP-FPM)
EXPOSE 9000

# Comando para rodar o PHP-FPM
CMD ["php-fpm"]
