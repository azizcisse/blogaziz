<?php

namespace App\EventSubscriber; 

use App\EventSubscriber\AdminSubscriber;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class AdminSubscriber implements EventSubscriberInterface
{
    public function getSubscribedEvents() 
    {
        return [
            BeforeEntityPersistedEvent::class => ['']
         ];
    }
    public function setEntityC
}