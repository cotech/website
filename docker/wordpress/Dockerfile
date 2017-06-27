FROM adamyeats/docker-nginx-hhvm-bedrock

# Allow Composer to run as superuser inside the container
# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
ENV COMPOSER_ALLOW_SUPERUSER 1

RUN apt-get update && apt-get install -y vim mysql-client

COPY docker/wordpress/docker-entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]

CMD ["nginx", "-g", "daemon off;"]
