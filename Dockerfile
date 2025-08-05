# 使用官方 PHP-FPM 映像檔作為基礎
FROM php:8.1-fpm-alpine

# 安裝必要的系統套件
RUN apk add --no-cache sqlite-dev

# 安裝 PHP 擴充功能
RUN docker-php-ext-install pdo pdo_sqlite

# 建立資料庫目錄並賦予 www-data 寫入權限
# 注意：這個指令需要在安裝擴充後執行
RUN mkdir -p /var/www/html/database && chown -R www-data:www-data /var/www/html/database