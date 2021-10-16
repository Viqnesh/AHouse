<?php

namespace App\Form;

use App\Entity\Calendrier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use App\Form\CalendarHabitatType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class DispoLogementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dateDispo', CollectionType::class, [
            'entry_type' => CalendarHabitatType::class,
            'entry_options' => ['label' => false],
            'allow_add' => true,
            'allow_delete' => true,
            'prototype'     => true,
            'by_reference' => false,
            'attr' => ['class' => 'js-datepicker'],


        ])
        ->add('save', SubmitType::class, [
            'attr' => ['class' => 'stripe-button'],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        ]);
    }
}
