<?php

namespace App\Managers;

use App\Entity\Incidencia;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use App\Event\IncidenciaEvent;
use App\Helper\AddCodigoIncidencia;


class IncidenciaManager
{

    protected $em;
    protected $class;
    protected $repository;
    protected $dispatcher;
    protected $addCodigoIncidencia;

    public function __construct(EntityManagerInterface $em, EventDispatcherInterface $dispatcher, AddCodigoIncidencia $addCodigoIncidencia)
    {
        $this->em = $em;
        $this->class = Incidencia::class;
        $this->repository = $this->em->getRepository($this->class);
        $this->dispatcher = $dispatcher;
        $this->addCodigoIncidencia = $addCodigoIncidencia;
    }

    public function newObject(): Incidencia
    {
        $incidencia = new $this->class;
        return $incidencia;
    }


    public function create(Incidencia $incidencia): Incidencia
    {

        $event = new IncidenciaEvent($incidencia);
        $this->addCodigoIncidencia->setCodigoIncidencia($incidencia);
        $this->dispatcher->dispatch(IncidenciaEvent::ADD, $event);

        $this->em->persist($incidencia);
        $this->em->flush();

        $this->addCodigoIncidencia->setCodigoIncidencia($incidencia);
        $this->em->flush();

        return $incidencia;

    }

    public function delete(Incidencia $incidencia):Incidencia
    {

        $this->em->remove($incidencia);
        $this->em->flush();

        return $incidencia;

    }

}