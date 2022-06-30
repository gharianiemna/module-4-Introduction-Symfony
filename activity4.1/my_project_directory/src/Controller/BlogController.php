<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Articles;


class BlogController extends AbstractController
{

        /**
     * @Route("/", name="home")
     */
    public Function home() {
        return $this->render('blog/home.html.twig', [
          'title' => "Bienvenue",
          'activity' => "Leçon 4.1 : Découverte De Symfony" ,
          'age' => 31
        ]);
    }


    /**
     * @Route("/blog", name="app_blog")
     */
    public function index(): Response
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

/**
 * @Route("/blog/{id}", name="blog_show" )
  */
   public Function show( int $id) {
   
        return $this->render('blog/show.html.twig', [
            'id' => $id,
        ]);
 }

/**
     * @Route("/article", name="article")
     */
    public function createArticle(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $article = new Articles();
        $article->setTitle("article")
        ->setAuthor("ghariani")
        ->setContent("Emailnhfcgsjdgfkjqhfsnbdvcjsdfsfshbdsbjdsgsgdjsdcjbvsfygfgdvhgdsvfsdqhksjhqkhsiqyhsjsqh")
        ->setDate(new \DateTime());

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($article);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        return new Response('Saved new product with id '.$article->getId());
      
    }



//     /**
//     * @Route("/blog/{id}", name="blog_show" , methods={"GET","HEAD"}, requirements={"id"="\d+"})
//     */
//    public Function show( int $id) {
//     if ($id==1) {
//         return $this->render('blog/show.html.twig');
//     } elseif ($id==2) {
//         return $this->render('blog/show2.html.twig');
//     } else{
//         return $this->render('blog/show3.html.twig');
//     }  
//  }
}
