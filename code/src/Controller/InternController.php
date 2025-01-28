<?php

namespace App\Controller;

use App\Entity\Intern;
use App\Form\InternType;
use App\Repository\InternRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    
    #[Route('/intern/{id}', name: 'intern_show', requirements: ['id' => '\d+'])]
    public function show(Intern $intern): Response
    {
        return $this->render('intern/show.html.twig', [
            'intern' => $intern 
        ]);
    }
    
    #[Route('/intern/delete/{id}', name: 'intern_delete', requirements: ['id' => '\d+'])]
    public function delete(Intern $intern, EntityManagerInterface $entityManager): Response
    { 
        $entityManager->remove($intern);
        $entityManager->flush();
        $this->addFlash('success', 'The intern has been sucessfully removed!');
        return $this->redirectToRoute('intern_index');
    }
    
    /*
        Cette approche d'utiliser deux routes pour une méthode est valable mais ne respecte pas le principe de responsabilité unique.
        Une meilleure approche serait de séparer le code en deux méthodes gérant chacun une route différente.
        Cela éviterait également les vérifications conditionnelles pour savoir si la route est edit ou add
    */
    #[Route('/intern/edit/{id}', name: 'intern_edit', requirements: ['id' => '\d+'])]
    #[Route('/intern/add', name: 'intern_add')]
    public function add_edit(Intern $intern = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        
        if(!$intern){
            $intern = new Intern();
        }

        $isEdit = $request->attributes->get('_route') === 'intern_edit';
        
        $form = $this->createForm(InternType::class, $intern);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $intern = $form->getData();
            $entityManager->persist($intern);
            $entityManager->flush();
            $isEdit ? 
                $this->addFlash('success', 'The intern has been sucessfully updated!')
                :
                $this->addFlash('success', 'The intern has been sucessfully added!');
            return $this->redirectToRoute("intern_index");
        }


        return $this->render('intern/add_edit.html.twig', [
            'internForm' => $form,
            'isEdit' => $isEdit
        ]);
    }

}
