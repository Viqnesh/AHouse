<?php

namespace App\Form;

use App\Entity\PriseDeVue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class PriseDeVueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url', FileType::class , ['label' => 'Ajouter une Photo','mapped' => false])
            ->add('add' , SubmitType::class, [
                'attr' => ['class' => 'btn-edit-profile '],
                'label' => "Envoyez"

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PriseDeVue::class,
        ]);
    }
}
