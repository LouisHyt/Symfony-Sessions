<?php

namespace App\Controller;

use App\Entity\Trainer;
use App\Form\TrainerType;
use App\Repository\TrainerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function add_edit(Trainer $trainer = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        if(!$trainer){
            $trainer = new Trainer();
        }

        $isEdit = $request->attributes->get('_route') === 'trainer_edit';
        $form = $this->createForm(TrainerType::class, $trainer);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $trainer = $form->getData();
            $entityManager->persist($trainer);
            $entityManager->flush();
            $isEdit ? 
                $this->addFlash('success', 'The trainer has been sucessfully updated!')
                :
                $this->addFlash('success', 'The trainer has been sucessfully added!');
            return $this->redirectToRoute("trainer_index");
        }


        return $this->render('trainer/add_edit.html.twig', [
            'trainerForm' => $form,
            'isEdit' => $isEdit
        ]);
    }

    #[Route('/trainer/delete/{id}', name: 'trainer_delete')]
    public function delete(Trainer $trainer, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($trainer);
        $entityManager->flush();
        $this->addFlash('success', 'The trainer has been sucessfully removed!');
        return $this->redirectToRoute('trainer_index');
    }
}
