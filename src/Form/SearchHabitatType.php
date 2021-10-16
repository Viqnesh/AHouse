<?php

namespace App\Form;

use App\Entity\Habitat;
use App\Entity\TypeHabitat;
use App\Entity\Region;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchHabitatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('region', EntityType::class, [
            // looks for choices from this entity
            'class' => Region::class,
            'label' => false,
            'help' => 'Make sure to add a valid email',
            'attr' => ['class' => 'champCustomize'],
            // uses the User.username property as the visible option string
            'choice_label' => 'Nom',

        
            'placeholder' => "Destination",

                        
            ])
            ->add('capacite',  ChoiceType::class, [
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
                    '10' => 10,],
                'choice_attr' =>  function($choice, $key, $value) {
                    return ['class' => 'optionNb'];
                 },
                'help' => 'Make sure to add a valid email',
                'placeholder' => 'Personnes',
                'attr' => ['class' => 'champCustomize'],
                'label' => false,

            ])
            ->add('idTypeHabitat', EntityType::class, [
                // looks for choices from this entity
                'class' => TypeHabitat::class,
                'label' => false,
                'help' => 'Make sure to add a valid email',

                // uses the User.username property as the visible option string
                'choice_label' => 'Nom',

            
                'placeholder' => "Type d'Habitat",
                'attr' => [
                    'id' => 'jetestedestrucs', 
                    'class' => 'champCustomize'
                ],
                            
            
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
                ])

            ->add('save', SubmitType::class, [
                ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Habitat::class,
        ]);
    }
}
