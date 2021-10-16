<?php

namespace App\Form;

use App\Entity\Coordonnees;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CoordonneesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('civilite', ChoiceType::class, [
                'choices'  => [
                    'Madame' => "Madame",
                    'Monsieur' => "Monsieur",

                ],
                'expanded' => true,
                'multiple' => false,
                ])
            ->add('nom', TextType::class, [
                'attr' => array(
                    'placeholder' => 'Votre Nom'
                )
            ])
            ->add('prenom', TextType::class,  [
                'attr' => array(
                    'placeholder' => 'Votre Prénom'
                )
            ])
            ->add('email', EmailType::class,  [
                'attr' => array(
                    'placeholder' => 'xyz@example.com'
                )
            ])
            ->add('telephone', NumberType::class,  [
                'attr' => array(
                    'placeholder' => 'Votre Numéro de Téléphone'
                )])
            ->add('adresse', TextType::class,  [
                'attr' => array(
                    'placeholder' => '123 Rue'
                )
            ])
            ->add('cp', NumberType::class,  [
                'attr' => array(
                    'placeholder' => 'Votre Code Postal'
                )
            ])
            ->add('ville', TextType::class,  [
                'attr' => array(
                    'placeholder' => 'Votre Ville',
                    'readonly' => true,


                ),
                'help' => 'Entrer votre code postal pour afficher votre ville',

            ])
            ->add('pays', CountryType::class,  [
                'preferred_choices' => ['FR'],
                ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'stripe-button'],

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Coordonnees::class,
        ]);
    }
}
