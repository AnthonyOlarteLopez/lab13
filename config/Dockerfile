FROM php:8.2-apache

# Instalar extensiones necesarias para PostgreSQL (Supabase)
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Copiar archivos del proyecto al servidor web
COPY . /var/www/html/

# Habilitar mod_rewrite (opcional)
RUN a2enmod rewrite

EXPOSE 80