<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Book;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        // $faker = Faker\Factory::create();
        $faker = Faker\Factory::create();

        // Création d'une vingtaine de livres ayant pour titre
        for ($i = 0; $i < 20; $i++) {
            $livre = new Book;
            $livre->setTitle($faker->sentence(4));
            $manager->persist($livre);
        }

        $manager->flush();
    }
}
