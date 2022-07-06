<?php

namespace App\Controller;
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\EquipeType;
use App\Entity\Equipe;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;



class SportsController extends AbstractController
{
    /**
     * @Route("/sports", name="app_sports")
     */
    public function index(): Response
    {
        return $this->render('sports/index.html.twig', [
            'controller_name' => 'SportsController',
        ]);
    }
     /**
     * @Route("/Equipe", name="Equipe_form")
     */
    public function EquipeForm (Request $request, ManagerRegistry $doctrine): Response

    {
        $Equipe = new Equipe();
        $form = $this->createForm(EquipeType::class, $Equipe);
        $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $doctrine->getManager();
                $entityManager->persist($Equipe);
                $entityManager->flush();  
                $this->addFlash('success', 'Created!');
                return $this->redirectToRoute('home');
            }
        return $this->render('sports/Equipe.html.twig', [
            'formEquipe' => $form->createView(),
            'Equipe' => $Equipe,
    
        ]);
}
}