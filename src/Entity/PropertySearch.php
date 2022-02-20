<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class PropertySearch
{

  /**
   * @var int|null
   */
  #[Assert\Type('int')]
  #[Assert\GreaterThan(30000)]
  private $maxPrice;

  /**
   * @var int|null
   */
  #[Assert\Type('int')]
  #[Assert\Range(min: 10, max: 200)]
  private $minSurface;


  public function getMaxPrice(): int|null
  {
    return $this->maxPrice;
  }


  public function setMaxPrice(int $maxPrice)
  {
    return $this->maxPrice = $maxPrice;
    return $this;
  }


  public function getMinSurface(): int|null
  {
    return $this->minSurface;
  }


  public function setMinSurface(int $minSurface)
  {
    return $this->minSurface = $minSurface;
    return $this;
  }
}
