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


    public function __construct(){
        $this->finder = new Finder;
        $this->filesystem = new Filesystem;

    }


    public function createEmptyFile(  $filename ): Response
   
    { $filesystem=new Filesystem();
        $finder = new Finder();
        $finder->directories()->in('../..')->name('web');
        foreach ($finder as $f) {$contents = $f->getRealPath();}

        // if (!$filesystem->exists($filename) .'txt'){
       $file=$filesystem->touch($contents.'/'.$filename);
       $message="new file created";
       return new Response($message);
    // }
  
    }


    public function createFile( $filename, $text ): Response
    {  $filesystem=new Filesystem();
        $finder = new Finder();
        $finder->directories()->in('../..')->name('web');
        foreach ($finder as $f) {$contents = $f->getRealPath();}
         $filesystem->appendToFile($contents.'/'.$filename, $text );
         $message=$filename . ' is added with the text: ' . $text;
            return new Response($message);
    }

   
    public function removeFile(  $filename ): Response
    { $filesystem=new Filesystem();
        $finder = new Finder();
        $finder->directories()->in('../..')->name('web');
        foreach ($finder as $f) {$contents = $f->getRealPath();}

        $src_dir_path = $contents.'/'.$filename;
        $filesystem->remove(['symlink', $src_dir_path , $filename]);
        $message="removed successfuly";
        return new Response($message);

    }
    // public function getHappyMessage(): string
    // {
    //     $messages = [
    //         'You did it! You updated the system! Amazing!',
    //         'That was one of the coolest updates I\'ve seen all day!',
    //         'Great work! Keep going!',
    //     ];

    //     $index = array_rand($messages);

    //     return $messages[$index];
    // }
}