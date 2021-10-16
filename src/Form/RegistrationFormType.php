<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'help' => "Votre adresse mail devrat être vérifier",
                
                'attr' => array(
                    'placeholder' => 'xyz@example.com',

                )])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => "J'accepte les Conditions Générales d'Utilisations ",
                    ]),
                ],
            ])
            ->add('password', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type' => PasswordType::class,
                'help' => "Votre mot de passe doit contenir au moins 6 caractères",

                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entre un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit faire au minimum 6 caractères',
                        'max' => 4096,
                    ]),
                ],
            ])

            ->add('nom', TextType::class, array('attr' => array(
                'placeholder' => 'Votre nom',
            )))
            ->add('genre', ChoiceType::class, [
                'choices'  => [
                    'Homme' => 'homme',
                    'Femme' => 'femme'
                ],
                'expanded' => true,
                'multiple' => false,
                'required' => true,
            ])
            ->add('prenom' , TextType::class,array('attr' => array(
                'placeholder' => 'Votre prénom',
            )))
            ->add('adresse' , TextType::class, array('attr' => array(
                'placeholder' => 'Votre adresse postale',
            )))
            ->add('ville', TextType::class, array('attr' => array(
                'placeholder' => 'Votre ville',
            )))
            ->add('cp' , NumberType::class, array('attr' => array(
                'placeholder' => 'Votre Code Postale',
            )))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
