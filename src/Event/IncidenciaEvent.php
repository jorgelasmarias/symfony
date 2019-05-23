<?php

namespace App\Event;
use Symfony\Component\EventDispatcher\Event;
use App\Entity\Incidencia;

class IncidenciaEvent extends Event{

    const ADD = 'incidencia.add';
    private $incidencia;

    public function __construct(Incidencia $incidencia)
    {
        $this->incidencia = $incidencia;
    }

    public function getIncidencia() {
        return $this->incidencia;
    }
}