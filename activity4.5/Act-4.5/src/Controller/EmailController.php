<?php

namespace App\Controller;
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\AdressMail;
use App\Form\AdressMailType;


class EmailController extends AbstractController
{
    /**
     * @Route("/email", name="app_email")
     */
    public function index(): Response
    {
        return $this->render('email/index.html.twig', [
            'controller_name' => 'EmailController',
        ]);
    }
        /** 
    * @Route("/Email/display", name="formEmail_display") 
    */ 

    public function getEmail(): Response
    {
        $repos=$this->getDoctrine()->getRepository(AdressMail::class);
        $Email=$repos->findAll();
        return $this->render('email/displayemail.html.twig', [
            'controller_name' => 'EmailController',
            'Email'=>$Email
        ]);
      
    }
    /**
     * @Route("/emailForm", name="emailvalid")
     */
    public function Email(Request $request, ManagerRegistry $doctrine): Response
     {
    $mail = new AdressMail();
    $form = $this->createForm(AdressMailType::class, $mail);
    $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($mail);
            $entityManager->flush();  
            $this->addFlash('success', 'Created! ');
            return $this->redirectToRoute('formEmail_display');
        }
    return $this->render('email/EmailForm.html.twig', [
        'formEmail' => $form->createView(),
        'Email' => $mail,

    ]);
    }
}
