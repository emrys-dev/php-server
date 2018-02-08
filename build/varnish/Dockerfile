FROM alpine:3.7

LABEL maintainer Rodrigo Ribeiro "labdocodigo"

RUN apk update

# bash
RUN apk add --update --no-cache bash

# varnish config
ENV VCL_CONFIG=/etc/varnish/default.vcl \
    CACHE_SIZE=128M \
    VARNISH_PORT="6081" \
    VARNISH_PORT2="6082" \
    VARNISH_PARAMS="-p default_ttl=60 -p default_grace=120" \
    VARNISHNCSA_ENABLED=1

# install varnish
RUN apk add --update --no-cache varnish=5.2.1-r0

# port
EXPOSE 6082 80

# clear cache
RUN rm -rf /tmp/* /var/cache/apk/*

# start
CMD varnishd -F \
    -f ${VCL_CONFIG} \
    -s malloc,${CACHE_SIZE} \
    -a :${VARNISH_PORT} \
    -T localhost:${VARNISH_PORT2} \
    ${VARNISH_PARAMS}