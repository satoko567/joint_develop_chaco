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

# Node.js のインストール
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - && \
    apt-get install -y nodejs

# Composer をインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /var/www/html

COPY . .

# ✅ ここが重要！npm のキャッシュ先を変更（root のフォルダを使わないように）
ENV npm_config_cache=/var/www/html/.npm-cache

# Composer install（本番環境用）
RUN composer install --no-plugins --no-scripts --optimize-autoloader --no-dev

# ✅ npm install / build は root 権限のまま安全に実行可能
RUN npm install && npm run prod

# ✅ 最後にパーミッション調整
RUN chown -R www-data:www-data /var/www/html

EXPOSE 8080

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
