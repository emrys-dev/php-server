FROM nginx:alpine

LABEL maintainer Rodrigo Ribeiro "labdocodigo"

RUN apk update

# bash
RUN apk add --update --no-cache bash

# app folder
RUN mkdir -p /var/www/html
WORKDIR /var/www/html

# ports
EXPOSE 80 8080

# clear cache
RUN rm -rf /tmp/* /var/cache/apk/*

# start
CMD ["nginx", "-g", "daemon off;"]