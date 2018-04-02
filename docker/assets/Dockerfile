FROM node:8.1.2

RUN apt-get update
RUN apt-get install -y apt-transport-https

RUN yarn global add npm

RUN npm install -g gulp

ADD download-images.sh /download-images.sh
RUN chmod +x /download-images.sh
