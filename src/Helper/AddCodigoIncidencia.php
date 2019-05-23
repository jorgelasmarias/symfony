<?php

namespace App\Helper;

use App\Entity\Incidencia;

class AddCodigoIncidencia
{

    public function setCodigoIncidencia(Incidencia $incidencia){

        $incidencia->setCodigo($incidencia->getId().'-'.date('Y'));

    }

}