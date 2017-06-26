FROM adamyeats/docker-nginx-hhvm-bedrock

RUN apt-get update && apt-get install -y vim mysql-client

COPY docker/wordpress/docker-entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

RUN curl -sL https://deb.nodesource.com/setup_6.x | bash -
RUN apt-get install -y nodejs

RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list
RUN apt-get update && apt-get install -y yarn

ENTRYPOINT ["/entrypoint.sh"]

CMD ["nginx", "-g", "daemon off;"]
