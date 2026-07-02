FROM richarvey/nginx-php-fpm:3.1.6

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN npm install && npm run build

RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear

RUN chmod -R 775 storage bootstrap/cache

ENV WEBROOT=/var/www/html/public
