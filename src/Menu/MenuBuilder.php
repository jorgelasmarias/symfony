<?php
// src/AppBundle/Menu/MenuBuilder.php

namespace App\Menu;

use Knp\Menu\FactoryInterface;

class MenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Incidencias', ['route' => 'incidencia_index', 'attributes' => ['class' => 'nav navbar-nav'] ]);
        $menu->addChild('Categorias', ['route' => 'categoria_index', 'attributes' => ['class' => 'nav navbar-nav'] ]);
        $menu->addChild('Tags', ['route' => 'tag_index', 'attributes' => ['class' => 'nav navbar-nav'] ]);
        $menu->addChild('Tasks', ['route' => 'task_index', 'attributes' => ['class' => 'nav navbar-nav'] ]);
        // ... add more children

        return $menu;
    }

    public function createSidebarMenu(array $options)
    {
        $menu = $this->factory->createItem('sidebar');

        //if (isset($options['include_homepage']) && $options['include_homepage']) {
        $menu->addChild('Home', ['route' => 'incidencia_index']);
        //}

        // ... add more children

        return $menu;
    }
}