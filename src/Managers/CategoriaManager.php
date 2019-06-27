<?php

namespace App\Managers;

use App\Entity\Categoria;
use Doctrine\ORM\EntityManagerInterface;


class CategoriaManager
{

    protected $em;
    protected $class;
    protected $repository;


    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->class = Categoria::class;
        $this->repository = $this->em->getRepository($this->class);

    }

    public function newObject(): Categoria
    {
        $categoria = new $this->class;
        return $categoria;
    }


    public function create(Categoria $categoria): Categoria
    {

        $this->em->persist($categoria);
        $this->em->flush();

        return $categoria;

    }

    public function delete(Categoria $categoria):Categoria
    {

        $this->em->remove($categoria);
        $this->em->flush();

        return $categoria;

    }

}