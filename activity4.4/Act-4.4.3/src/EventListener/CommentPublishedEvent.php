<?php 

namespace App\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use App\Entity\Comment;

/**
 * @var Comment $_comment
 */

class CommentPublishedEvent extends Event
{
    const NAME = 'comment.published';  
    private $_comment;  
    
    public function __construct(Comment $comment) { 
       $this->_comment = $comment; 
    }  
    public function getcomm() { 
    
       return $this->_comment; 
    } 
    public function getArticle(){
        return $this->_comment->getArticle();
    }

 }  
//  $event = new CommentPublishedEvent($_comment);
