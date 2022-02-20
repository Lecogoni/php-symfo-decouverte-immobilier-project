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