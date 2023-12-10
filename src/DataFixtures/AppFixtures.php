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
        $comment1->setState('published');
        $manager->persist($comment1);

//        $comment2 = new Comment();
//        $comment2->setConference($milan);
//        $comment2->setAuthor('Lucas');
//        $comment2->setEmail('lucas@example.com');
//        $comment2->setText('Creo que ha sido bastante moderada');
//        $manager->persist($comment2);

        $manager->flush();
    }
}
