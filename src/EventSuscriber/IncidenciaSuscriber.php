<?php 

namespace App\EventSuscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Event\IncidenciaEvent;

class IncidenciaSuscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return [
            IncidenciaEvent::ADD => 'addException'
        ];
    }

    public function addException(IncidenciaEvent $event)
    {
        //die('HOLA CARACOLA');
    }

} 