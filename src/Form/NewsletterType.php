<?php

namespace App\Form;

use App\Entity\Newsletter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\TypeHabitat;
use App\Entity\Region;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class NewsletterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class, [
                'help' => "Votre adresse mail devrat être vérifier",
                
                'attr' => array(
                    'placeholder' => 'xyz@example.com',

                )
            ])
            ->add('prenom')
            ->add('anniversaire' , DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],
                'html5' => false,
            ])
            ->add('hebergement', EntityType::class, [
                // looks for choices from this entity
                'class' => TypeHabitat::class,
                'label' => false,
                'help' => 'Make sure to add a valid email',

                // uses the User.username property as the visible option string
                'choice_label' => 'Nom',

            
                'placeholder' => "Choisissez une valeur",
                'attr' => [
                    'id' => 'jetestedestrucs', 
                ],
                            
            
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
                ])
            ->add('region', EntityType::class, [
                // looks for choices from this entity
                'class' => Region::class,
                'label' => false,
                'help' => 'Make sure to add a valid email',
                // uses the User.username property as the visible option string
                'choice_label' => 'Nom',
    
            
                'placeholder' => "Choisissez une valeur",
    
                            
                ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'bouton-violet'],

            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Newsletter::class,
        ]);
    }
}
