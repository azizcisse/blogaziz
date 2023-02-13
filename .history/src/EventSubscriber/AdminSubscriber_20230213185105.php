<?php

namespace App\EventSubscriber; 

use App\EventSubscriber\AdminSubscriber;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class AdminSubscriber implements EventSubscriberInterface
{
    return [
               BeforeEntityPersistedEvent::class => 
    ];
}