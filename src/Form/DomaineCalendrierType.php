<?php

namespace App\Form;

use App\Entity\Domaine;
use App\Entity\DispoDomaine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use App\Form\LocationOccupantType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Form\DispoDomaineType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DomaineCalendrierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dispoDomaine', CollectionType::class, [
            'entry_type' => DispoDomaineType::class,
            'entry_options' => ['label' => false],
            'allow_add' => true,
            'allow_delete' => true,
            'prototype'     => true,
            'by_reference' => false,

            ])
        ->add('save', SubmitType::class, [
            'attr' => ['class' => 'stripe-button'],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Domaine::class,

        ]);
    }
}
