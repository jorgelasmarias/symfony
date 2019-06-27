<?php

namespace App\Managers;

use App\Entity\Tag;
use Doctrine\ORM\EntityManagerInterface;


class TagManager
{

    protected $em;
    protected $class;
    protected $repository;


    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->class = Tag::class;
        $this->repository = $this->em->getRepository($this->class);

    }

    public function newObject(): Tag
    {
        $tag = new $this->class;
        return $tag;
    }


    public function create(Tag $tag): Tag
    {

        $this->em->persist($tag);
        $this->em->flush();

        return $tag;

    }

    public function delete(Tag $tag):Tag
    {

        $this->em->remove($tag);
        $this->em->flush();

        return $tag;

    }

}