<?php

namespace App\Controller;

use App\Entity\Intern;
use App\Repository\InternRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class InternController extends AbstractController{
    #[Route('/intern', name: 'intern_index')]
    public function index(InternRepository $internRepository): Response
    {

        $interns = $internRepository->findAll();
        return $this->render('intern/index.html.twig', [
            'interns' => $interns
        ]);
    }

    #[Route('/intern/{id}', name: 'intern_show')]
    public function show(Intern $intern): Response
    {
        return $this->render('intern/show.html.twig', [
           'intern' => $intern 
        ]);
    }

    #[Route('/intern/delete/{id}', name: 'intern_delete')]
    public function delete(): Response
    {   
        return $this->render('intern/show.html.twig');
    }

    #[Route('/intern/edit/{id}', name: 'intern_edit')]
    #[Route('/intern/add', name: 'intern_add')]
    public function edit(): Response
    {
        return $this->render('intern/show.html.twig');
    }
}
