<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PropertyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

      $faker = Faker\Factory::create('fr_FR');

      for ($i = 0; $i < 10; $i++) {
        $property = new Property();
        $property->setTitle('mon bien ' . $faker->word . ' ' . $i);
        $property->setDescription('desription de mon bien ' .  $i);
        $property->setSurface(mt_rand(10, 100));
        $property->setRooms(mt_rand(1, 10));
        $property->setBedrooms(mt_rand(1, 8));
        $property->setFloor(mt_rand(1, 6));
        $property->setPrice(mt_rand(50000, 200000));
        $property->setHeat(1);
        $property->setCity($faker->city);
        $property->setAddress($i . ' ' . $faker->streetName);
        $property->setSold(0);
        $property->setPostalCode($faker->postcode);
        
        
        $manager->persist($property);
     }
    $manager->flush();
    }
}
