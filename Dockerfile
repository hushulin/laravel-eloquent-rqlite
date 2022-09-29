FROM php:8.1-fpm-buster

RUN sed -i 's/deb.debian.org/mirrors.ustc.edu.cn/g' /etc/apt/sources.list
RUN sed -i 's/security.debian.org/mirrors.ustc.edu.cn/g' /etc/apt/sources.list

RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
RUN sed -i 's/upload_max_filesize\ =\ 2M/upload_max_filesize\ =\ 10M/g' /usr/local/etc/php/php.ini
RUN sed -i 's/post_max_size\ =\ 8M/post_max_size\ =\ 10M/g' /usr/local/etc/php/php.ini
RUN sed -i 's/memory_limit\ =\ 128M/memory_limit\ =\ 4096M/g' /usr/local/etc/php/php.ini
RUN sed -i 's/max_execution_time\ =\ 30/max_execution_time\ =\ 600/g' /usr/local/etc/php/php.ini

RUN apt-get update && apt-get install -y libevent-dev openssl libssl-dev
RUN docker-php-ext-install sockets && docker-php-ext-enable sockets
RUN pecl install redis && docker-php-ext-enable redis
RUN apt-get update \
    # gd
    #&& apt-get install -y --no-install-recommends libfreetype6-dev libjpeg-dev libpng-dev libwebp-dev  \
    && apt-get install -y zlib1g-dev libpng-dev vim \
    && docker-php-ext-configure gd \
    && docker-php-ext-install gd \
    && apt-get install -y wget git zip unzip libzip-dev \
    && docker-php-ext-install zip \
    && wget -nv -O /usr/local/bin/composer https://oss-resource.lyky.com.cn/depends/php/composer.phar \
    # https://github.com/composer/composer/releases/download/${COMPOSER_VERSION}/composer.phar
    && chmod u+x /usr/local/bin/composer \
    # gmp
    && apt-get install -y --no-install-recommends libgmp-dev \
    && docker-php-ext-install gmp \
    # pdo_mysql
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install bcmath \
    # opcache
    && docker-php-ext-enable opcache \
    # zip
    #&& docker-php-ext-install zip \
    # clean up
    && apt-get autoclean -y \
    && rm -rf /var/lib/apt/lists/* \
    && rm -rf /tmp/pear/

COPY . /app
WORKDIR /app
#RUN composer config -g repo.packagist composer https://packagist.phpcomposer.com
#RUN composer config -g repos.packagist composer https://mirrors.aliyun.com/composer/
#RUN composer config -g repos.packagist composer https://php.cnpkg.org
#RUN composer install
#RUN php artisan optimize:clear
#RUN composer dump-autoload
#RUN ln -s /app/storage/app/uploads /app/public/
#RUN chmod -R 777 /app/storage && chmod -R 777 /app/public && chmod a+x /app/run-scheduler.sh
#
