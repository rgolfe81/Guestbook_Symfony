<?php

namespace App\Controller;

use App\Repository\ConferenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConferenceController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(ConferenceRepository $conferenceRepository)
    {
        $conferences = $conferenceRepository->findAll();

        return $this->render('conference/index.html.twig',
        [
            'conferences_twig' => $conferences
        ]);
    }
}
