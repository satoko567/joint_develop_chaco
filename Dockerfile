# syntax = docker/dockerfile:experimental

FROM php:7.4-fpm

# PHP拡張をインストール
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libzip-dev \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip

# Node.jsのインストール
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - && \
    apt-get install -y nodejs

# Composerを入れる
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /var/www/html

COPY . .

# Composer install（rootでOK）
RUN composer install --no-plugins --no-scripts --optimize-autoloader --no-dev

# ✅ npm install / run prod は root のまま
RUN npm install && npm run prod

# ✅ あとで www-data に所有権を戻す（必要に応じて）
RUN chown -R www-data:www-data /var/www/html

# 必要ならユーザー切り替え
USER www-data

EXPOSE 8080

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
