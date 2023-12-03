<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Conference;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $milan = new Conference();
        $milan->setCity('Milan');
        $milan->setYear('2005');
        $milan->setIsInternational(true);
        $manager->persist($milan);

        $sevilla = new Conference();
        $sevilla->setCity('Sevilla');
        $sevilla->setYear('2006');
        $sevilla->setIsInternational(false);
        $manager->persist($sevilla);

        $comment1 = new Comment();
        $comment1->setConference($milan);
        $comment1->setAuthor('Fabian');
        $comment1->setEmail('fabian@example.com');
        $comment1->setText('Esta fue una buena conferencia, si señor!');
        $manager->persist($comment1);

        $manager->flush();
    }
}
