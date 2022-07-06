<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\Event;
use Twig\Environment;

class CommentPublishedSubscriber implements EventSubscriberInterface

{
    private $_mailer;
    private $_engine;
    public function __construct(\Swift_Mailer $mailer, Environment $engine)
    {
    $this->_mailer=$mailer;
    }
    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return [
            CommentPublishedEvent::NAME =>'onCommentPublished'
        ];
    }

    public function onCommentPublished(CommentPublishedEvent $event)
    {$comment =$event->getComment();
        $article=$event->getArticle();
        //send an email to the publisher
     $message =( new \Swift_Message($comment->getName().'you commented successfully on the article'. $article->getTitle()))
        ->setFrom('no-reply@talan.com')
        ->setTo($comment->getEmail())
        ->setBody($this->_engine->render('mail/mail.html.twig' [
           'comment'=> $comment
        ]));
        return $this->_mailer->send($message);
    }
   

   
}