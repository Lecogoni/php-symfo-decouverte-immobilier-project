
Project découverte de Symfo

# SETUP INFO - DOCKER CONTAINER

- container php-apache : `docker run -tid --name php-symfo-decouverte-beweb-immobilier-project php:8.0-apache``

- docker run -d --name php-symfo-decouverte-beweb-immobilier-project-db -p 7790:3306 -e MYSQL_ROOT_PASSWORD=${MYSQL_ROOT_PASSWORD} -e MYSQL_DATABASE=mydb -e MYSQL_USER=${MYSQL_user} -e MYSQL_PASSWORD=${MYSQL_PASSWORD} mysql:5.7


# PACKAGIST

- cocur/slugify