FROM php:7.2-fpm-stretch

MAINTAINER Jimmy <stefan.brankovik@cosmicdevelopment.com>

### NGINX
ARG NGINX_VERSION=1.10.3-1+deb9u3
ARG YARN_VERSION=1.12.3-1

RUN apt-get update
RUN apt-get install -y --no-install-recommends apt-utils gnupg2 apt-transport-https

### Required repositories
RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
    && echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list
RUN curl -sL https://deb.nodesource.com/setup_8.x | bash -

### NGINX
RUN addgroup --system nginx \
    && adduser --system --ingroup nginx --disabled-password --home /var/cache/nginx --disabled-login nginx \
    && apt-get install -y nginx=${NGINX_VERSION} \
    && apt-get install -y mariadb-client
# Sites folders and link configuration
RUN unlink /etc/nginx/sites-enabled/default \
    && mkdir -p /usr/share/nginx/logs \
    && touch /usr/share/nginx/logs/error.log

# CRON
RUN touch /var/log/cron.log
RUN apt-get -y install cron

# Required packages ( supervisor and composer )
RUN apt-get install -y wget supervisor curl ca-certificates dialog git unzip\
    musl-dev libpng-dev libffi-dev vim libsqlite3-dev libicu-dev libxml2-dev libjpeg-dev libfreetype6-dev

### PHP
RUN pecl install xdebug-2.6.1
RUN docker-php-ext-enable xdebug \
    && docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-png-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install pdo_mysql pdo_sqlite mysqli gd exif intl json soap dom zip opcache bcmath sockets \
    && docker-php-source delete \
    && mkdir -p /run/nginx \
    && mkdir -p /var/log/supervisor \
    && sed -i "1 s/^/;/" /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN EXPECTED_COMPOSER_SIGNATURE=$(wget -q -O - https://composer.github.io/installer.sig) \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('SHA384', 'composer-setup.php') === '${EXPECTED_COMPOSER_SIGNATURE}') { echo 'Composer.phar Installer verified'; } else { echo 'Composer.phar Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php --install-dir=/usr/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

### NODEJS + YARN
RUN apt-get install -y yarn=${YARN_VERSION}
RUN apt-get install -y nodejs

### CLEANUP
RUN rm -rf /var/cache/* \
    && apt-get purge -y gcc musl-dev linux-headers libffi-dev python-dev autoconf && apt-get autoremove -y

### Make scipt executable
ADD local/scripts/start.sh /entrypoint.sh

CMD ["/entrypoint.sh"]
