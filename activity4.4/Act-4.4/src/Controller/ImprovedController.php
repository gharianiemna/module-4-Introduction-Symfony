<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Service\FileSystemImproved;


class ImprovedController extends AbstractController
{
      /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return $this->render('Improved/home.html.twig', [
            'controller_name' => 'ImprovedController',
        ]);
    }
    /**
     * @Route("/Improved", name="app_Improved")
     */
    public function index(): Response
    {
        return $this->render('Improved/index.html.twig', [
            'controller_name' => 'ImprovedController',
        ]);
    }

    
         /**
     * @Route("/create-file/{filename}", name="create_empty_file")
     */
    public function create_Empty_File(FileSystemImproved $fileSystemImproved, $filename): Response
   
    { $file= $fileSystemImproved->createEmptyFile($filename);
        $this->addFlash('success', $file);
        return new JsonResponse(json_encode($file));
    }
   

    /**
     * @Route("/write-in-file/{filename}/{text}", name="create_file_with_text")
     */
    public function create_File( FileSystemImproved $fileSystemImproved, $filename, $text ): Response
    {  
        $file= $fileSystemImproved-> createFile($filename, $text );
         return new JsonResponse(json_encode($file));
    }

           /**
     * @Route("/delete-file/{filename}", name="remove_text")
     */
    public function remove_file(FileSystemImproved $fileSystemImproved, $filename ): Response
    { 
        $file= $fileSystemImproved->removeFile($filename);
        return new JsonResponse(json_encode($file));
    }

    //     /**
    //  * @Route("/Improveds/new")
    //  */
    // public function new(FileSystemImproved $messageGenerator): Response
    // {   $message = $messageGenerator->getHappyMessage();
    //     $this->addFlash('success', $message);
    //     return new Response($message);
    // }
}
