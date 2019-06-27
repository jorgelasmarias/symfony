<?php

namespace App\Form;

use App\Entity\Incidencia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class IncidenciaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Título'])
            ->add('description', TextareaType::class, ['label' => 'Descripción', 'required' => false])
            ->add('created', DateType::class, ['label' => 'Fecha de creación', 'widget' => 'single_text'])
            ->add('resolved', CheckboxType::class, ['label' => 'Resuelto', 'required' => false])
            ->add('resolution', DateType::class, ['label' => 'Fecha de resolución', 'widget' => 'single_text', 'required' => false])
            ->add('categoria')
            ->add('tags')
            ->add('attachment', FileType::class, array('data_class' => null));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Incidencia::class
        ]);
    }

}