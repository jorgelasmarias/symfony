<?php

namespace App\Twig;

use Twig\Extension\RuntimeExtensionInterface;

class FechaRuntime implements RuntimeExtensionInterface
{

    public function horaEspanola($date)
    {
        $date = date_format($date,'d-m-Y');

        return $date;

    }
}

