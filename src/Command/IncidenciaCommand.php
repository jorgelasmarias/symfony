<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Question\ChoiceQuestion;
use App\Managers\IncidenciaManager;

class IncidenciaCommand extends Command
{
    protected static $defaultName = 'app:incidencia';
    private $im;

    public function __construct(IncidenciaManager $incidenciaManager)
    {   

        $this->im =  $incidenciaManager;
        
        parent::__construct();
    }

    protected function configure()
    {
        /*$this->addArgument('title',InputArgument::REQUIRED, 'Titulo de la incidencia');
        $this->addArgument('description',InputArgument::OPTIONAL, 'Descripción de la incidencia');
        $this->addArgument('created',InputArgument::OPTIONAL, 'Fecha de creación');
        //$this->addArgument('resolved',InputArgument::OPTIONAL, '¿Está resuelta?');
        $this->addArgument('resolution',InputArgument::OPTIONAL, 'Fecha de resolución');
        $this->addArgument('categoria',InputArgument::OPTIONAL, 'Categoria');*/
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $incidencia = $this->im->newObject();
        $helper = $this->getHelper('question');

        $question = new Question('Introduce un titulo: ', ' Prueba');
        $titulo = $helper->ask($input, $output, $question);

        $question = new Question('Introduce una descripcion: ', ' Prueba');
        $descripcion = $helper->ask($input, $output, $question);

        $question = new Question('Introduce una Fecha de creacion: ', '');
        $fcreacion = $helper->ask($input, $output, $question);


        $question =  new ChoiceQuestion('¿Está creado?',['y', 'n']);
        $created = $helper->ask($input, $output, $question);


        $question = new Question('Introduce una Fecha de resolución: ', '');
        $fresolucion = $helper->ask($input, $output, $question);

        $incidencia->setTitle($titulo);
        $incidencia->setDescription($descripcion);
        $incidencia->setCreated(new \DateTime());
        $incidencia->setResolved($created==0?true:false);

        $this->im->create($incidencia);

        /*$bundles = ['AcmeDemoBundle', 'AcmeBlogBundle', 'AcmeStoreBundle'];
        $question = new Question('Please enter the name of a bundle', 'FooBundle');
        $question->setAutocompleterValues($bundles);*/

    }
}