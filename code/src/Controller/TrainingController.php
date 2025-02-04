<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Training;
use App\Form\TrainingSessionType;
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

    #[Route('/training/edit/{id}', name: 'training_edit', requirements: ['id' => '\d+'])]
    #[Route('/training/add', name: 'training_add')]
    public function add_edit(Training $training = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        if(!$training){
            $training = new Training();
        }

        $isEdit = $request->attributes->get('_route') === 'training_edit';
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

    #[Route('/training/delete/{id}', name: 'training_delete', requirements: ['id' => '\d+'])]
    public function delete(Training $training, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($training);
        $entityManager->flush();
        $this->addFlash('success', 'The training has been sucessfully removed!');
        return $this->redirectToRoute('training_index');
    }
}
