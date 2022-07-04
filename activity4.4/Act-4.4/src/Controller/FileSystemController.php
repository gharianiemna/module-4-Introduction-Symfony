<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class FileSystemController extends AbstractController
{
    /**
     * @Route("/file/system", name="app_file_system")
     */
    public function index(): Response
    {
        return $this->render('file_system/index.html.twig', [
            'controller_name' => 'FileSystemController',
        ]);
    }

    /**
     * @Route("/create/{filename}", name="create_empty_file")
     */
    public function createEmptyFile( Filesystem $filesystem, $filename ): Response
   
    { 
        $finder = new Finder();
        $finder->directories()->in('../..')->name('web');
        foreach ($finder as $f) {$contents = $f->getRealPath();}

        if (!$filesystem->exists($filename) .'txt'){
       
      $filesystem->touch($contents.'/'.$filename);
    }
    return new Response($filename . ' created succesffully ');
    }

    /**
     * @Route("/write/{filename}/{text}", name="create_file_with_text")
     */
    public function createFile( Filesystem $filesystem, $filename, $text ): Response
    {   $finder = new Finder();
        $finder->directories()->in('../..')->name('web');
        foreach ($finder as $f) {$contents = $f->getRealPath();}
         $filesystem->appendToFile($contents.'/'.$filename, $text );
            return new Response($filename . ' is added with the text: ' . $text);
    }

        /**
     * @Route("/copy/{source}/{target}", name="copy_text")
     */
    public function copierText( Filesystem $filesystem, $source, $target ): Response
    { 
        $finder = new Finder();
        $finder->directories()->in('../..')->name('web');
        foreach ($finder as $f) {$contents = $f->getRealPath();}
        $src_dir_path = $contents.'/'.$source;
            $dest_dir_path = $contents . "/".$target;
            if (!$filesystem->exists($src_dir_path)){
                return new Response($source . ' is not found please enter exiting file');
            }else{   
            $filesystem->copy($src_dir_path, $dest_dir_path , true); 
             return new Response($source . ' is copied'); 
            }
   
    }


        /**
     * @Route("/delete/{filename}", name="remove_text")
     */
    public function removeText( Filesystem $filesystem, $filename ): Response
    { 
        $finder = new Finder();
        $finder->directories()->in('../..')->name('web');
        foreach ($finder as $f) {$contents = $f->getRealPath();}

        $src_dir_path = $contents.'/'.$filename;
        $filesystem->remove(['symlink', $src_dir_path , $filename]);
    return new Response('removed successfuly ');
    }



    /**
     * @Route("/find", name="find_path")
     */
    public function find( Filesystem $filesystem ): Response
    { 
        
    $finder = new Finder();
        $finder->directories()->in('../..')->name('web');

    foreach ($finder as $f) {
    $contents = $f->getRealPath();

}
return new Response($contents);
}
}
