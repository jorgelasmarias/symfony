<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Categoria;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titleSearch', TextType::class, ['label' => 'Título', 'required' => false])
            ->add('categorySearch', EntityType::class,[ 'class' => Categoria::class, 'required' => false,  'multiple' => false, 'by_reference' => false])
            ->add('submit', SubmitType::class, ['label' => 'Filtrar']);
    }


}