<?php

namespace App\Controller;

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\LinkType;
use App\Entity\Link;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;


class LinkController extends AbstractController
{
    /**
     * @Route("/link", name="app_link")
     */
    public function index(): Response
    {
        return $this->render('link/index.html.twig', [
            'controller_name' => 'LinkController',
        ]);
    }
        /** 
    * @Route("/link/display", name="link_display") 
    */ 

    public function getLink(): Response
    {
        $repos=$this->getDoctrine()->getRepository(Link::class);
        $link=$repos->findAll();
        return $this->render('link/displaylink.html.twig', [
            'controller_name' => 'LinkController',
            'link'=>$link
        ]);
      
    }
    
    /**
     * @Route("/link", name="link_form")
     */
    public function LinkForm (Request $request, ManagerRegistry $doctrine): Response

    {
        $link = new Link();
        $form = $this->createForm(LinkType::class, $link);
        $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $doctrine->getManager();
                $entityManager->persist($link);
                $entityManager->flush();  
                $this->addFlash('success', 'Created!');
                return $this->redirectToRoute('link_display');
            }
        return $this->render('link/Formlink.html.twig', [
            'formlink' => $form->createView(),
            'link' => $link,
    
        ]);
       

    }

}
