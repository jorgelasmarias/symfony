<?php

namespace App\Managers;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;


class TaskManager
{

    protected $em;
    protected $class;
    protected $repository;


    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->class = Task::class;
        $this->repository = $this->em->getRepository($this->class);

    }

    public function newObject(): Task
    {
        $task = new $this->class;
        return $task;
    }


    public function create(Task $task): Task
    {

        $this->em->persist($task);
        $this->em->flush();

        return $task;

    }

    public function delete(Task $task):Task
    {

        $this->em->remove($task);
        $this->em->flush();

        return $task;

    }

}