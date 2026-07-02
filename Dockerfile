FROM richarvey/nginx-php-fpm:3.1.6

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-scripts

# RUN npm install && npm run build

RUN chmod -R 775 storage bootstrap/cache

ENV WEBROOT=/var/www/html/public
