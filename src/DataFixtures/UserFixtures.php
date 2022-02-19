<?php

namespace App\DataFixtures;

use App\Entity\User;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Config\SecurityConfig;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class UserFixtures extends Fixture
{


    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
      $this->passwordHasher = $passwordHasher;
    }


    /**
     * Here we create some user to populate the db
     * IMPORTANT password are encrypt with bcrypt to match security requiremetn set in security.yaml
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 2; $i++) {

          $plaintextPassword = 'immo';
          
          #$hashedPassword = $security->passwordHasher('immo');
          $user = new User();
          
          $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $plaintextPassword
          );

          $user->setUsername($faker->firstNameMale);
          $user->setPassword($hashedPassword);
          $manager->persist($user);
        }
        $manager->flush();
    }
}


# $passwordHash = $encoder->encodePassword($userClassName, $userClassName->getPassword());
#$userClassName->setPassword($passwordHash);