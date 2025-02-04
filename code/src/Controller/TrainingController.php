<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Training;
use App\Form\TrainingType;
use App\Repository\TrainingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TrainingController extends AbstractController{
    #[Route('/training', name: 'training_index')]
    public function index(TrainingRepository $trainingRepository): Response
    {

        $trainings = $trainingRepository->findAll();

        return $this->render('training/index.html.twig', [
            'trainings' => $trainings
        ]);
    }

    #[Route('/training/add', name: 'training_add')]
    public function add(Training $training = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        if(!$training){
            $training = new Training();
        }

        $isEdit = false;
        $form = $this->createForm(TrainingType::class, $training);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $training = $form->getData();
            $entityManager->persist($training);
            $entityManager->flush();
            $isEdit ? 
                $this->addFlash('success', 'The training has been sucessfully updated!')
                :
                $this->addFlash('success', 'The training has been sucessfully added!');
            return $this->redirectToRoute("training_index");
        }


        return $this->render('training/add_edit.html.twig', [
            'trainingForm' => $form,
            'isEdit' => $isEdit
        ]);
    }

    #[Route('/training/edit/{id}', name: 'training_edit', requirements: ['id' => '\d+'])]
    public function edit(Training $training = null, Request $request, EntityManagerInterface $entityManager): Response
    {

        $isEdit = true;
        $form = $this->createForm(TrainingType::class, $training);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $training = $form->getData();
            $entityManager->persist($training);
            $entityManager->flush();
            $this->addFlash('success', 'The training has been sucessfully updated!');
            return $this->redirectToRoute("training_index");
        }

        $availableSessions = $entityManager->getRepository(Session::class)->findAvailableSessions();


        return $this->render('training/add_edit.html.twig', [
            'trainingForm' => $form,
            'isEdit' => $isEdit,
            'trainingSessions' => $training->getSessions(),
            'availableSessions' => $availableSessions
        ]);
    }
}
