<?php

namespace App\Controller;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Article;
use App\Entity\Comment;
use App\Form\CommentType;
use App\EventListener\CommentPublishedEvent;
use Symfony\Component\EventDispatcher\Event;



class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_article")
     */
    public function index(): Response
    {
        $repos=$this->getDoctrine()->getRepository(Article::class);
        $Article=$repos->findAll();
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'Article'=>$Article
        ]);
    }

    /**
 * @Route("/{id}", name="article")
*/
public function article(Request $request, ManagerRegistry $doctrine, $id, EventDispatcherInterface $dispatcher ){
    // On récupère l'article correspondant à l'id
    $article = $this->getDoctrine()->getRepository(Article::class)->findOneBy(['id' => $id]);

    // On récupère les commentaires actifs de l'article
    $commentaires = $this->getDoctrine()->getRepository(Comment::class)->findBy([
        'article' => $article
    ]);

    if(!$article){
        // Si aucun article n'est trouvé, nous créons une exception
        throw $this->createNotFoundException('L\'article n\'existe pas');
    }
    $comm = new Comment();
    $comm ->setArticle($article);
    $form = $this->createForm(CommentType::class, $comm);
    $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($comm);
            $entityManager->flush();  
            $this->addFlash('success', 'Created! ');
            $event=new CommentPublishedEvent($comm);
            $dispatcher->dispatch(CommentPublishedEvent::NAME, $event );
            return $this->redirectToRoute('article', ['id' => $id]);
        }


    // Si l'article existe nous envoyons les données à la vue
    return $this->render('article/article.html.twig', [
        'article' => $article,
        'commentaires' => $commentaires,
        'form' => $form->createView(),
    ]);
}

}
