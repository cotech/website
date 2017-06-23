FROM adamyeats/docker-nginx-hhvm-bedrock

RUN apt-get update && apt-get install -y vim mysql-client

COPY docker/wordpress/docker-entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

RUN curl -sL https://deb.nodesource.com/setup | bash -
RUN apt-get install -yq nodejs
RUN npm install -g gulp

ENTRYPOINT ["/entrypoint.sh"]

CMD ["nginx", "-g", "daemon off;"]
