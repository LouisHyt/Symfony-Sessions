<?php

namespace App\Controller;

use App\Entity\Intern;
use App\Entity\Module;
use App\Entity\Program;
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
    public function add_edit(
        Session $session = null, 
        Request $request, 
        EntityManagerInterface $entityManager, 
        SessionRepository $sessionRepository
    ): Response
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
        $availableModules = $sessionRepository->findAvailableModules($session->getId());


        return $this->render('session/add_edit.html.twig', [
            'sessionForm' => $form,
            'isEdit' => $isEdit,
            'session' => $session,
            'availableInterns' => $availableInterns,
            'availableModules' => $availableModules
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
        return $this->redirectToRoute('session_edit', [
            'id' => $session->getId()
        ]
        );
    }

    #[Route('/session/removeIntern/{intern}/{session}', name: 'session_removeIntern', requirements: ['intern' => '\d+', 'session' => '\d+'])]
    public function removeIntern(Session $session, Intern $intern, EntityManagerInterface $entityManager): Response
    {
        $session->removeIntern($intern);
        $entityManager->persist($session);
        $entityManager->flush();
        $this->addFlash('success', 'The intern has been sucessfully removed to the session!');
        return $this->redirectToRoute('session_edit', [
            'id' => $session->getId()
        ]);
    }

    #[Route('/session/addProgram/{session}', name: 'session_addProgram', requirements: ['session' => '\d+'])]
    public function add_Program(Session $session, EntityManagerInterface $entityManager, Request $request): Response
    {

        $days = $request->request->get('totaldays');
        $moduleId = $request->request->get('module');

        // Validation des données
        if (!is_numeric($days) || $days <= 0) {
            $this->addFlash('error', 'The amount of days must be a positive number.');
            $referer = $request->headers->get('referer');
            return $this->redirect($referer);
        }

        // Vérification de l'existence du module
        $module = $entityManager->getRepository(Module::class)->find($moduleId);
        if (!$module) {
            $this->addFlash('error', 'The selected module does not exist.');
            $referer = $request->headers->get('referer');
            return $this->redirect($referer);
        }

        // Création et persistance du nouveau Programme
        $program = new Program();
        $program->setTotalDays($days);
        $program->setModule($module);
        $program->setSession($session);

        $entityManager->persist($program);
        $entityManager->flush();

        $this->addFlash('success', 'The module "'.$module->getName().'" has been sucessfully added.');
        $referer = $request->headers->get('referer');
        return $this->redirect($referer);
    }

    #[Route('/session/editProgram/{program}/{session}', name: 'session_editProgram', requirements: [ 'program' => '\d+', 'session' => '\d+'])]
    public function editProgram(Session $session, Program $program = null, EntityManagerInterface $entityManager, Request $request): Response
    {
        $days = $request->request->get('totaldays');
        if (!is_numeric($days) || $days <= 0) {
            $this->addFlash('error', 'The amount of days must be a positive number.');
            $referer = $request->headers->get('referer');
            return $this->redirect($referer);
        }

        $program->setTotalDays($days);
        $entityManager->persist($program);
        $entityManager->flush();
        $this->addFlash('success', 'The module '.$program->getModule()->getName().' has been sucessfully updated for the session "'.$session->getName().'" ! ');
        $referer = $request->headers->get('referer');
        return $this->redirect($referer);
    }

    #[Route('/session/removeProgram/{program}/', name: 'session_removeProgram', requirements: ['program' => '\d+'])]
    public function removeProgram(Program $program, EntityManagerInterface $entityManager, Request $request): Response
    {
        $entityManager->remove($program);
        $entityManager->flush();
        $this->addFlash('success', 'The module "'.$program->getModule()->getName().'" "has been sucessfully removed!');
        $referer = $request->headers->get('referer');
        return $this->redirect($referer);
    }

}
