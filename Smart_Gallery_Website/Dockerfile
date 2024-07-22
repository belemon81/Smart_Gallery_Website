FROM php:8.1-fpm-alpine 
WORKDIR /app
RUN apk add icu-dev
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install intl
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apk add --no-cache bash && \
    curl -sS https://get.symfony.com/cli/installer | bash && \
    mv /root/.symfony5/bin/symfony /usr/local/bin/symfony
COPY composer.json .
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-dev --prefer-dist
RUN composer update
ENV APP_ENV="dev"
ENV APP_SECRET="81adb4b12643b84efccbee6ecf3e0134"
ENV MESSENGER_TRANSPORT_DSN="doctrine://default?auto_setup=0"
ENV DATABASE_URL="mysql://root:root@db:3306/gallery?serverVersion=8.0.32"
COPY . .
RUN mkdir -p public/uploads/artworks && chmod -R 777 public/uploads/artworks
EXPOSE 8000
CMD ["symfony", "server:start"]