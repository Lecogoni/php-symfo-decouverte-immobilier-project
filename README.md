
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




----------


<?php

namespace App\Entity;

class PropertySearch
{

  /**
   * @var int|null
   */
  private $maxPrice;

  /**
   * @var int|null
   */
  private $minSurface;

  /**
   * @Route("Route", name="RouteName")
   */
  public function getMaxPrice(): int
  {
      return $this->maxPrice;

  }
  
  /**
   * @Route("Route", name="RouteName")
   */
  public function setMaxPrice(int $maxPrice): PropertySearch
  {
      return $this->maxPrice = $maxPrice;
      return $this;
  }

  /**
   * @Route("Route", name="RouteName")
   */
  public function getMinSurface(): int
  {
      return $this->minSurface;

  }
  
  /**
   * @Route("Route", name="RouteName")
   */
  public function setMinSurface(int $minSurface): PropertySearch
  {
      return $this->minSurface = $minSurface;
      return $this;
  }



}