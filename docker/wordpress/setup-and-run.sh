#!/bin/bash

set -eu

export COMPOSER_NO_INTERACTION=1

function wp {
  /usr/local/bin/wp "$@" --allow-root
}

function wait-for-db {
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
}

cd /app

composer install

WORDPRESS_THEME=coop-tech-oowp-theme
WORDPRESS_THEME_PATH="web/app/themes/$WORDPRESS_THEME"

if [ -f "$WORDPRESS_THEME_PATH/composer.json" ]; then
  echo "Running composer install for theme"
  (cd $WORDPRESS_THEME_PATH && composer install)
fi

# Checking if we have already installed WordPress
if wp core is-installed; then

  echo "WordPress is already installed!"

else

  wait-for-db

  wp core install \
     --url="$WP_HOME" \
     --title=WordPress \
     --admin_user=dev \
     --admin_password=dev \
     --admin_email=admin@test.org \
     --skip-email

  wp plugin activate --all
  wp theme activate "$WORDPRESS_THEME"
  wp rewrite structure '/%postname%/'

fi

echo >&2 "========================================================================"
echo >&2
echo >&2 "Alright! WordPress was configured!"
echo >&2
echo >&2 "You should be able to visit it in your browser at $WP_HOME"
echo >&2
echo >&2 "The WordPress backend can be found at $WP_HOME/wp/wp-admin"
echo >&2
echo >&2 "========================================================================"

php -S 0.0.0.0:8080 -t /app/web /app/web/server.php
