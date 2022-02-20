
Project découverte de Symfo

# SETUP INFO - DOCKER CONTAINER

- container php-apache : `docker run -tid --name php-symfo-decouverte-beweb-immobilier-project php:8.0-apache``

- docker run -d --name php-symfo-decouverte-beweb-immobilier-project-db -p 7790:3306 -e MYSQL_ROOT_PASSWORD=${MYSQL_ROOT_PASSWORD} -e MYSQL_DATABASE=mydb -e MYSQL_USER=${MYSQL_user} -e MYSQL_PASSWORD=${MYSQL_PASSWORD} mysql:5.7


# PACKAGIST

- cocur/slugify


# USE OF ...


- use of Fixtures and Faker to populate the db
- use of Sf UserPasswordHasherInterface to encrypt password
- set pagination with KnpLabs / KnpPaginatorBundle `https://github.com/KnpLabs/KnpPaginatorBundle`
- filter system on property based on entity not using to the ORM - not persist in db - PropertySearch.php



----------

