<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;


class UserController extends AbstractController
{
    /**
 * @Route("/", name="home")
 */
public Function home() {
    return $this->render('user/home.html.twig');
}
    /**
     * @Route("/user", name="app_user")
     */
    public function index(): Response
    {
        // $repo=$this->getDoctrine()->getRepository(User::class);
        // $users=$repo->findAll();
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            // 'users' =>$users
        ]);
    }
    /**
 * @Route("/home", name="homehome")
 */
public Function homehome() {
    return $this->render('user/home2.html.twig');
}
    /**
     * @Route("/create", name="form")
     */
    public function createUser(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $user = new User();
        $user->setFirstName("emna")
        ->setLastname("ghariani")
        ->setEmail("Email")
        ->setAdress("Adress")
        ->setBirthday(\DateTime::createFromFormat('Y-m-d', "1992-11-09"));

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($user);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$user->getId());
      
    }
/**
     * @Route("/getall", name="form")
     */
    public function getUser(): Response
    {
        $repo=$this->getDoctrine()->getRepository(User::class);
        $users=$repo->findAll();
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'users' =>$users
        ]);
      
    }
}
