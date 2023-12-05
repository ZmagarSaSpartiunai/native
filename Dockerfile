# Используем образ PHP 7.4 с FPM (FastCGI Process Manager)
FROM php:7.4-fpm

# Устанавливаем необходимые расширения PHP
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Устанавливаем composer
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Копируем файлы приложения в рабочую директорию контейнера
COPY . /var/www

# Устанавливаем рабочую директорию
WORKDIR /var/www


# Устанавливаем права на директорию сеансов PHP-FPM
RUN mkdir /var/www/storage
RUN chmod -R 777 /var/www/storage


# Определяем точку входа для запуска PHP-FPM
CMD ["php-fpm"]

EXPOSE 9000
