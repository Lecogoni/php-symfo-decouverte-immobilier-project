<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PropertyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        
        $property = new Property();
        
        $manager->persist($product);
        $manager->flush();
    }
}
