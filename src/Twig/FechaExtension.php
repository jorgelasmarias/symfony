<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class FechaExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('horaEspanola', [FechaRuntime::class, 'horaEspanola'])
        ];
    }


}

