<?php

namespace App\Form;

use App\Entity\Habitat;
use App\Entity\TypeHabitat;
use App\Entity\Activite;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;


class HabitatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('idTypeHabitat', EntityType::class, [
                // looks for choices from this entity
                'class' => TypeHabitat::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => 'Nom',
            
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('nbCouchages', ChoiceType::class, [
                'choices' => [ 
                '1' => 1,
                '2' => 2,
                '3' => 3,
                '4' => 4,
                '5' => 5,
                '6' => 6,
                '7' => 7,
                '8' => 8,
                '9' => 9,
                '10' => 10,
                ]
            ])
            ->add('capacite', ChoiceType::class, [
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,
                    '8' => 8,
                    '9' => 9,
                    '10' => 10,
                ]
            ])
            ->add('prix', MoneyType::class)
            ->add('ville', TextType::class)
            ->add('url',FileType::class, array('data_class' => null))
            ->add('description', TextareaType::class)
            ->add('activiteHabitat', EntityType::class, [
                // looks for choices from this entity
                'class' => Activite::class,
                'mapped' => false ,
                // uses the User.username property as the visible option string
                'choice_label' => 'Nom',
            
                // used to render a select box, check boxes or radios
                'multiple' => true,
                'expanded' => true
            ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'btn-edit-profile '],
                'label' => "Enregistrez"

            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Habitat::class,
        ]);
    }
}
