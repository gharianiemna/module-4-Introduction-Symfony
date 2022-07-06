<?php


namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\JsonResponse;

class FileSystemImproved
{
    private $finder;
    private $filesystem;


    public function __construct(Filesystem $filesystem){
        $this->finder = new Finder;
        $this->filesystem = $filesystem;

    }


    public function createEmptyFile(  $filename ): Response
   
    { 
     
        $this->finder->directories()->in('../..')->name('web');
        foreach ( $this->finder as $f) {$contents = $f->getRealPath();}

        // if (!$filesystem->exists($filename) .'txt'){
       $file=$this->filesystem->touch($contents.'/'.$filename);
       $message="new file created";
       return new Response($message);
    // }
  
    }


    public function createFile( $filename, $text ): Response
    {  
        $this->finder->directories()->in('../..')->name('web');
        foreach ($this->finder as $f) {$contents = $f->getRealPath();}
         $this->filesystem->appendToFile($contents.'/'.$filename, $text );
         $message=$filename . ' is added with the text: ' . $text;
            return new Response($message);
    }

   
    public function removeFile(  $filename ): Response
    { 
        
        $this->finder->directories()->in('../..')->name('web');
        foreach ($this->finder as $f) {$contents = $f->getRealPath();}

        $src_dir_path = $contents.'/'.$filename;
        $this->filesystem->remove(['symlink', $src_dir_path , $filename]);
        $message="removed successfuly";
        return new Response($message);

    }

}