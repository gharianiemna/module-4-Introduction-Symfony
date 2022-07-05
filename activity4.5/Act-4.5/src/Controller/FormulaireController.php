<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\AdressMail;
use App\Entity\Montant;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UserType;
use App\Form\MontantType;
use App\Form\AdressMailType;
class FormulaireController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {        return $this->render('formulaire/home.html.twig', [
            'controller_name' => 'FormulaireController']);
    }
    /** 
    * @Route("/user/display", name="user_display") 
    */ 

    public function getUser(): Response
    {
        $repos=$this->getDoctrine()->getRepository(User::class);
        $User=$repos->findAll();
        return $this->render('formulaire/display.html.twig', [
            'controller_name' => 'FormulaireController',
            'User'=>$User,

        ]);
      
    }

    /** 
    * @Route("/Montant/display", name="Montant_display") 
    */ 

    public function getMontant(): Response
    {
        $repos=$this->getDoctrine()->getRepository(Montant::class);
        $Montant=$repos->findAll();
        return $this->render('formulaire/displayfull.html.twig', [
            'controller_name' => 'FormulaireController',
            'Montant'=>$Montant,

        ]);
      
    }


    /** 
    * @Route("/Email/display", name="formEmail_display") 
    */ 

    public function getEmail(): Response
    {
        $repos=$this->getDoctrine()->getRepository(AdressMail::class);
        $Email=$repos->findAll();
        return $this->render('formulaire/displayemail.html.twig', [
            'controller_name' => 'FormulaireController',
           
            'Email'=>$Email,
            'msg'=>''
        ]);
      
    }





    /**
     * @Route("/formulaire", name="formulaire")
     */
    public function newform(Request $request, ManagerRegistry $doctrine): Response
     {
        $User = new User();
        $form = $this->createForm(UserType::class, $User);
        $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($User);
            $entityManager->flush();  
            $this->addFlash('success', 'Created! ');
            return $this->redirectToRoute('formulaire2');
             }
         return $this->render('formulaire/index.html.twig', [
        'formUser' => $form->createView(),
        'User' => $User,
    ]);
    }

     /**
     * @Route("/formulaire2", name="formulaire2")
     */
    public function nextform(Request $request, ManagerRegistry $doctrine): Response
     {
    $Montant = new Montant();
    $form = $this->createForm(MontantType::class, $Montant);
    $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($Montant);
            $entityManager->flush();  
            $this->addFlash('success', 'Created! ');

              return $this->redirectToRoute('Montant_display');
        }
    return $this->render('formulaire/formulaire2.html.twig', [
        'formMontant' => $form->createView(),
        'Montant' => $Montant,

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
    return $this->render('formulaire/EmailForm.html.twig', [
        'formEmail' => $form->createView(),
        'Email' => $mail,

    ]);
    }
}
