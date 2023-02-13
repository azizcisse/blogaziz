<?php

namespace App\EventSubscriber; 

use App\EventSubscriber\AdminSubscriber;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;


class AdminSubscriber implements EventSubscriberInterface
{
    public function getSubscribedEvents() 
    {
        return [
            BeforeEntityPersistedEvent::class => ['setEntityCreatedAt']
         ];
    }
    public function setEntityCreatedAt(BeforeEntityPersistedEvent $event)
    {
        $entity = 
    }
}