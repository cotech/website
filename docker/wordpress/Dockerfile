FROM php:7.1.12

COPY . /app

# install package dependencies
#   git/subversion/unzip are used whilst install composer dependencies
#   mysql client is used inside the setup script
#--------------------------------------

RUN apt-get update && apt-get install -y \
    git \
    subversion \
    unzip \
    mysql-client

# install composer
#--------------------------------------

RUN curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/local/bin --filename=composer

# install wp cli
#--------------------------------------

RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && \
    chmod +x wp-cli.phar && \
    mv wp-cli.phar /usr/local/bin/wp

# install php extensions
#--------------------------------------

RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mysqli

# add extra files to container
#--------------------------------------

COPY setup-and-run.sh /setup-and-run.sh
COPY php.ini /usr/local/etc/php/php.ini

WORKDIR /app

CMD ["/setup-and-run.sh"]
