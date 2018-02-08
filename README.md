# Build and pull SSL image:
docker build -t labdocodigo/ssl:latest .
docker push labdocodigo/ssl:latest

# Build and pull VARNISH image:
docker build -t labdocodigo/varnish:latest .
docker push labdocodigo/varnish:latest

# Build and pull WEB image:
docker build -t labdocodigo/web:latest .
docker push labdocodigo/web:latest

# Build and pull PHP image:
docker build -t labdocodigo/php:latest .
docker push labdocodigo/php:latest

# Gerar Certificados:
sudo openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /mnt/d/Projects/superhype/ssl/nginx.key -out /mnt/d/Projects/superhype/ssl/nginx.crt

TODO:
- WAF


configs
networks
ssl
${


/var/log/nginx/

php 7.2+
php-fpm
nginx
non blocking I/O
amphp
reactphp
phtreads
thread safe
nodejs
npm
yeowman
webpack


docker login
docker ps -a
docker run --name test -p 8080:80 -d nginx
docker run --name test -p 8080:80 -it nginx bash
docker stop
docker stop $(docker ps -a -q)
docker rm
docker rm $(docker ps -a -q)
docker system prune -a
docker inspect --format '{{ .NetworkSettings.IPAddress }}' CONTAINER_ID
docker images
docker build .
docker build -t labdocodigo/php:latest .
docker tag labdocodigo/php:latest labdocodigo/php:latest &&
docker push labdocodigo/php:latest