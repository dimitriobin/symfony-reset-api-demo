<?php

namespace App\DataFixtures;

use App\Entity\Author;
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

        $author_list = [];
        for ($i = 0; $i < 10; $i++) {
            $author = new Author();
            $author->setFirstName($faker->firstName());
            $author->setLastName($faker->name());
            $manager->persist($author);
            $author_list[] = $author;
        }

        // Création d'une vingtaine de books ayant pour titre
        for ($i = 0; $i < 20; $i++) {
            $book = new Book();
            $book->setTitle($faker->sentence(4));
            $book->setAuthor($author_list[array_rand($author_list)]);
            $manager->persist($book);
        }


        $manager->flush();
    }
}
