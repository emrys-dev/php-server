# Dockerized Webserver Project 
- Nginx/Nasxi/SSL container
- Varnish cache container
- Nginx web server container
- PHP-FPM 7.2+ container
- PerconaDB container

# Generate Certificates:
> sudo openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /mnt/d/Projects/webserver/ssl/nginx.key -out /mnt/d/Projects/webserver/ssl/nginx.crt

> sudo openssl dhparam -out /mnt/d/Projects/webserver/ssl/nginx.pem 4096

# Build and pull SSL image:
> docker build -t ssl .
> docker tag ssl labdocodigo/ssl
> docker push labdocodigo/ssl:latest

# Build and pull VARNISH image:
> docker build -t varnish .
> docker tag varnish labdocodigo/varnish
> docker push labdocodigo/varnish:latest

# Build and pull WEB image:
> docker build -t web .
> docker tag web labdocodigo/web
> docker push labdocodigo/web:latest

# Build and pull PHP image:
> docker build -t php .
> docker tag php labdocodigo/php
> docker push labdocodigo/php:latest

# COMMANDS
docker images
docker ps (docker container ls)
docker-compose up -d
docker-compose down
docker stop $(docker ps -a -q)
docker rm $(docker ps -a -q)
docker system prune -a
docker network ls
docker network rm
docker exec -it ssl nginx -s reload
docker exec -it web nginx -s reload
docker exec -it varnish bash -x /etc/init.d/varnishd reload
git add *
git commit -m "New itens"
git push origin master

# TODO
- Upload folder security
- PHP HTTP filters
- Varnish cache headers
- Log rotate
- Database
- Web service system
- Daemons system