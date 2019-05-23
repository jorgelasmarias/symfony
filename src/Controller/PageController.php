<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PageController extends AbstractController{
    /**
     * @Route("/primera-pagina")
     */
    public function index(){
        $name = 'Jorge';
        return $this->render('page/index.html.twig',
            [
                'name' => $name
            ]
        );
    }

}