<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;
use App\Entity\Messages;
use  App\Repository\UserRepository;
use  App\Repository\MessageRepository;
class UserController extends AbstractController


{
    /**
     * @Route("/user", name="app_user")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }


           /**
     * @Route("/user/{id}", name="user.detail")
     */
    public function show(int $id): Response
    {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneByIdJoinedToMessage($id);

        $message = $user->getMesaage();
        return $this->render('user/details.html.twig', [
                    'user' => $user,
                    'message' => $message,
]);
    }
    // public function showById(MessageRepository $msgRepository, UserRepository $userRepository,$id)
    // {
    //     $user = $userRepository->find($id);
    
    //     $msg = $msgRepository->find($user->getMessage());

    //     $texts = $msg->getText();
    //     return $this->render('user/details.html.twig', [
    //         'user' => $user,
    //         'texts' => $texts,
          
    //     ]);
    // }

}
