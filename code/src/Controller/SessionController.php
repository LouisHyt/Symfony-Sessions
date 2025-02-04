<?php

namespace App\Controller;

use App\Entity\Intern;
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

    #[Route('/session/edit/{id}', name: 'session_edit', requirements: ['id' => '\d+'])]
    #[Route('/session/add', name: 'session_add')]
    public function add_edit(Session $session = null, Request $request, EntityManagerInterface $entityManager, SessionRepository $sessionRepository): Response
    {
        if(!$session){
            $session = new Session();
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

        $availableInterns = $sessionRepository->findAvailableInterns($session->getId());


        return $this->render('session/add_edit.html.twig', [
            'sessionForm' => $form,
            'isEdit' => $isEdit,
            'sessionInterns' => $session->getInterns(),
            'availableInterns' => $availableInterns
        ]);
    }

    #[Route('/session/delete/{id}', name: 'session_delete', requirements: ['id' => '\d+'])]
    public function delete(Session $session, EntityManagerInterface $entityManager): Response
    { 
        $entityManager->remove($session);
        $entityManager->flush();
        $this->addFlash('success', 'The session has been sucessfully removed!');
        return $this->redirectToRoute('session_index');
    }

    #[Route('/session/addIntern/{intern}/{session}', name: 'session_addIntern', requirements: ['intern' => '\d+', 'session' => '\d+'])]
    public function addIntern(Session $session, Intern $intern, EntityManagerInterface $entityManager): Response
    {
        $session->addIntern($intern);
        $entityManager->persist($session);
        $entityManager->flush();
        $this->addFlash('success', 'The intern has been sucessfully added to the session!');
        return $this->redirectToRoute('session_edit', ['id' => $session->getId()]);
    }

    #[Route('/session/removeIntern/{intern}/{session}', name: 'session_removeIntern', requirements: ['intern' => '\d+', 'session' => '\d+'])]
    public function removeIntern(Session $session, Intern $intern, EntityManagerInterface $entityManager): Response
    {
        $session->removeIntern($intern);
        $entityManager->persist($session);
        $entityManager->flush();
        $this->addFlash('success', 'The intern has been sucessfully removed to the session!');
        return $this->redirectToRoute('session_edit', ['id' => $session->getId()]);
    }
}
