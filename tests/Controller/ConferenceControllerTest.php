<?php

namespace App\Tests\Controller;

use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConferenceControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Deja tu comentario');
    }

    public function testConferencePage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertCount(2, $crawler->filter('h4'));

        $client->clickLink('Ver');

        $this->assertPageTitleContains('Milan');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Milan 2005');
        $this->assertSelectorExists('div:contains("Hay 1 comentario")');
    }

    public function testCommentSubmission()
    {
        $client = static::createClient();
        $client->request('GET', '/conference/milan-2005');
        $client->submitForm('Submit', [
            'comment_form[author]' => 'Fabian',
            'comment_form[text]' => 'Some feedback from an automated functional test',
            'comment_form[email]' => $email = 'me@automat.ed',
            'comment_form[photo]' => dirname(__DIR__, 2).'/public/images/under-construction.gif',
        ]);
        $this->assertResponseRedirects();

        // simulate comment validation
//        $comment = self::$container->get(CommentRepository::class)->findOneByEmail($email);
//        $comment->setState('published');
//        self::$container->get(EntityManagerInterface::class)->flush();

        $client->followRedirect();
        $this->assertSelectorExists('div:contains("Hay 2 comentarios")');
    }
}