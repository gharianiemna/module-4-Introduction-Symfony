<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Category;

class CategoryController extends AbstractController
{
    
    /**
 * @Route("/", name="home")
 */
public Function home() {
    return $this->render('category/home.html.twig');
}
    /**
     * @Route("/category", name="app_category")
     */
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }
          /**
     * @Route("/create-cat/{name}", name="category.create", methods={"GET","HEAD"},requirements={"id"="\d+"})
     */
    public function createProduct(ManagerRegistry $doctrine, string $name): Response
    {
        $entityManager = $doctrine->getManager();

        $cat = new Category();
        $cat->setName($name);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($cat);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new category with id '.$cat->getId());
      
    }
}
