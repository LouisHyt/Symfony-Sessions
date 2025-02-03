<?php

namespace App\Controller;

use App\Repository\TrainerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TrainerController extends AbstractController{
    #[Route('/trainer', name: 'trainer_index')]
    public function index(TrainerRepository $trainerRepository): Response
    {

        $trainers = $trainerRepository->findBy([], ['lastName' => 'DESC']);
        return $this->render('trainer/index.html.twig', [
            'trainers' => $trainers
        ]);
    }

    #[Route('/trainer/edit/{id}', name: 'trainer_edit', requirements: ['id' => '\d+'])]
    #[Route('/trainer/add', name: 'trainer_add')]
    public function add_edit(): Response
    {
        return $this->redirectToRoute('trainer_index');
    }

    #[Route('/trainer/delete/{id}', name: 'trainer_delete')]
    public function delete(TrainerRepository $trainerRepository): Response
    {

        return $this->redirectToRoute('trainer_index');
    }
}
