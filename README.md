# Dockerized Webserver Project 
- Nginx/Nasxi/SSL container
- Varnish cache container
- Nginx web server container
- PHP-FPM 7.2+ container
- Mariadb container
- Redis container

# Generate Certificates:
> sudo openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /mnt/d/Projects/webserver/ssl/nginx.key -out /mnt/d/Projects/webserver/ssl/nginx.crt

> sudo openssl dhparam -out /mnt/d/Projects/webserver/ssl/nginx.pem 4096

# Build and pull SSL image:
> docker build -t labdocodigo/ssl:latest .

> docker push labdocodigo/ssl:latest

# Build and pull VARNISH image:
> docker build -t labdocodigo/varnish:latest .

> docker push labdocodigo/varnish:latest

# Build and pull WEB image:
> docker build -t labdocodigo/web:latest .

> docker push labdocodigo/web:latest

# Build and pull PHP image:
> docker build -t labdocodigo/php:latest .

> docker push labdocodigo/php:latest

# COMMANDS
docker stop $(docker ps -a -q)
docker rm $(docker ps -a -q)
docker system prune -a
docker exec -it ssl nginx -s reload
docker exec -it web nginx -s reload
docker exec -it varnish bash -x /etc/init.d/varnishd reload

# TODO
- Phalcon skeleton
- Upload folder security
- Class load
- PHP HTTP filters
- Varnish cache headers
- Log rotate
- Database
- Daemons system
- Web service system