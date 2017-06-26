#!/bin/bash

set -e

echo "Starting up entrypoint script"

# Composer acts as if --no-interaction was passed
export COMPOSER_NO_INTERACTION=1

# Composer does not warn when we are superuser inside the Docker container
export COMPOSER_ALLOW_SUPERUSER=1

cd /var/www/html

composer update

if [ -z "$WORDPRESS_ROOT" ]; then
  # assume bedrock wordpress location
  WORDPRESS_ROOT="/var/www/html/web/wp"
fi

chown -R www-data:www-data $WORDPRESS_ROOT /var/www/html/vendor

# checking if we have already installed it...
if wp core is-installed --path=$WORDPRESS_ROOT --allow-root; then

  echo "Wordpress is already installed!"

else

  echo "Installing wordpress at $WORDPRESS_ROOT"

  # wait for db to be ready
  echo "Waiting for database to be available"

  while ! mysql \
    -h $DB_HOST \
    -u $DB_USER \
    -p$DB_PASSWORD \
    --silent -e 'select 1' \
    $DB_NAME \
    >/dev/null 2>&1;
    do sleep 1
  done

  wp core install \
    --path=$WORDPRESS_ROOT \
    --url=http://localhost:18080 \
    --title=dev \
    --admin_user=dev \
    --admin_password=dev \
    --admin_email=null@null.com \
    --skip-email \
     --allow-root

  # activate plugins

  WORDPRESS_PLUGINS=$(ls $WORDPRESS_ROOT/../app/plugins)

  wp --allow-root --path=$WORDPRESS_ROOT \
    plugin activate $WORDPRESS_PLUGINS \
    || true # allow error, the world will keep turning if some don't activate...

  # activate theme

  WORDPRESS_THEME=$(ls $WORDPRESS_ROOT/../app/themes | head -n1)

  wp theme activate $WORDPRESS_THEME \
    --path=$WORDPRESS_ROOT \
    --allow-root

  # configure wordpress

  wp rewrite structure '/%postname%/' \
    --path=$WORDPRESS_ROOT \
    --allow-root

  # import imports

  shopt -s nullglob

  if [ -d lib/imports ]; then
    for filename in lib/imports/*.xml; do
      wp import $filename --authors=skip \
        --path=$WORDPRESS_ROOT \
        --allow-root
    done
  fi

fi

echo "Compiling WordPress theme"

cd /var/www/html/web/app/themes/coop-tech-oowp-theme
composer install
yarn
./node_modules/gulp/bin/gulp.js

cd /var/www/html
curl https://www.coops.tech/cotech-images.tgz > cotech-images.tgz
tar -zxf cotech-images.tgz  -C web
rm cotech-images.tgz

echo "Assets compiled"

# change nginx port...

sed -i 's/listen 80/listen 18080/g' /etc/nginx/sites-enabled/bedrock

chown www-data:www-data /var/run/hhvm/hhvm.hhbc

# bring up our PHP binaries
/etc/init.d/php5-fpm start
/etc/init.d/hhvm start

echo >&2 "========================================================================"
echo >&2
echo >&2 "Alright! Wordpress was configured!"
echo >&2
echo >&2 "========================================================================"

exec "$@"
