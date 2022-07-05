<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UserType;


class FormulaireController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return $this->render('formulaire/home.html.twig', [
            'controller_name' => 'FormulaireController',
        ]);
    }

    /** 
   * @Route("/formulaire/display", name="formulaire_display") 
*/ 

    public function getUser(): Response
    {
        $repo=$this->getDoctrine()->getRepository(User::class);
        $users=$repo->findAll();
        return $this->render('formulaire/display.html.twig', [
            'controller_name' => 'productController',
            'User' =>$users,
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
    $msg ='User Created Succesffully !';
    return $this->redirectToRoute('formulaire_display', ['msg'=>$msg]);
}
    return $this->render('formulaire/index.html.twig', [
        'formUser' => $form->createView(),
        'User' => $User,

    ]);
    }

}
