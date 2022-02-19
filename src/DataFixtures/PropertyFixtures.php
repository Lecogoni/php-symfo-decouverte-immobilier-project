<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PropertyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
      for ($i = 0; $i < 10; $i++) {
        $property = new Property();
        $property->setTitle('mon bien '. $i);
        $property->setDescription('description de mon bien '. $i);
        $property->setSurface(mt_rand(10, 100));
        $property->setRooms(mt_rand(1, 10));
        $property->setBedrooms(mt_rand(1, 8));
        $property->setFloor(mt_rand(1, 6));
        $property->setPrice(mt_rand(50000, 200000));
        $property->setHeat(1);
        $property->setCity('montpellier');
        $property->setAddress($i . ' rue du test');
        $property->setSold(0);
        $property->setPostalCode('34000');
        
        
        $manager->persist($property);
     }
    $manager->flush();
    }
}
