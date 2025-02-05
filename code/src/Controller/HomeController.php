<?php

namespace App\Controller;

use App\Entity\Session;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController{
    #[Route('/', name: 'home_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {

        $sessionsData = $entityManager->getRepository(Session::class)->getGlobalInfos();
        return $this->render('home/index.html.twig', [
            'sessionsData' => $sessionsData,
        ]);
    }
}
