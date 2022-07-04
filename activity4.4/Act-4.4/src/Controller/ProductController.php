<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\MessageGenerator;


class ProductController extends AbstractController
{
      /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return $this->render('product/home.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }
    /**
     * @Route("/product", name="app_product")
     */
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

        /**
     * @Route("/products/new")
     */
    public function new(MessageGenerator $messageGenerator): Response
    {
        // thanks to the type-hint, the container will instantiate a
        // new MessageGenerator and pass it to you!
        // ...

        $message = $messageGenerator->getHappyMessage();
        $this->addFlash('success', $message);
        return new Response($message);
    }
}
