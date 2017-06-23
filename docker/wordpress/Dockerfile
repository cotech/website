FROM adamyeats/docker-nginx-hhvm-bedrock

RUN apt-get update && apt-get install -y vim mysql-client

COPY docker/wordpress/docker-entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]

CMD ["nginx", "-g", "daemon off;"]
