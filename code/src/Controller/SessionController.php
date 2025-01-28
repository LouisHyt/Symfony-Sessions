<?php

namespace App\Controller;

use App\Entity\Session;
use App\Form\SessionType;
use App\Repository\SessionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SessionController extends AbstractController{
    #[Route('/session', name: 'session_index')]
    public function index(SessionRepository $sessionRepository): Response
    {

        $sessions = $sessionRepository->findBy([], ['beginDate' => 'DESC']);

        return $this->render('session/index.html.twig', [
            'sessions' => $sessions
        ]);
    }

    #[Route('/intern/edit/{id}', name: 'session_edit', requirements: ['id' => '\d+'])]
    #[Route('/session/add', name: 'session_add')]
    public function add_edit(Session $session = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        if(!$session){
            $session = new session();
        }
    
        $isEdit = $request->attributes->get('_route') === 'session_edit';

        $form = $this->createForm(SessionType::class, $session);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $session = $form->getData();
            $entityManager->persist($session);
            $entityManager->flush();
            $isEdit ? 
                $this->addFlash('success', 'The session has been sucessfully updated!')
                :
                $this->addFlash('success', 'The session has been sucessfully added!');
            return $this->redirectToRoute("session_index");
        }


        return $this->render('session/add_edit.html.twig', [
            'sessionForm' => $form,
            'isEdit' => $isEdit
        ]);
    }
}
