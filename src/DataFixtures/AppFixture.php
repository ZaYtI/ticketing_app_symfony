<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixture extends Fixture
{

    public function __construct(private readonly UserPasswordHasherInterface $hasher){}

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        /* USER */
        $user = new User();
        $user->setEmail('admin@gmail.com');
        $user->setRole(['ROLE_ADMIN']);
        $user->setPassword($this->hasher->hashPassword($user,'admin'));
        $manager->persist($user);

        $user = new User();
        $user->setEmail('user@gmail.com');
        $user->setPassword($this->hasher->hashPassword($user,'user'));
        $manager->persist($user);


        $manager->flush(); //Envoie en BD
    }
}
