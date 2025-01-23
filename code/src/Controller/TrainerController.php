<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TrainerController extends AbstractController{
    #[Route('/trainer', name: 'trainer_index')]
    public function index(): Response
    {
        return $this->render('trainer/index.html.twig', [
            'controller_name' => 'TrainerController',
        ]);
    }
}
