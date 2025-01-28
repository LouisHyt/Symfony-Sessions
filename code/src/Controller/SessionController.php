<?php

namespace App\Controller;

use App\Repository\SessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SessionController extends AbstractController{
    #[Route('/session', name: 'session_index')]
    public function index(SessionRepository $sessionRepository): Response
    {

        $sessions = $sessionRepository->findAll();

        return $this->render('session/index.html.twig', [
            'sessions' => $sessions
        ]);
    }

    #[Route('/session/add', name: 'session_add')]
    public function add(): Response
    {
        return $this->render('session/add_edit.html.twig');
    }
}
