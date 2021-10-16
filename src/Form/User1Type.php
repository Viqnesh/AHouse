<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;

use Symfony\Component\OptionsResolver\OptionsResolver;

class User1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('login', TextType::class , ['label' => "Nom d'utilisateur"])
        ->add('password', PasswordType::class , ['label' => 'Mot de Passe']
        )
        ->add('email', EmailType::class , ['label' => 'Adresse E-Mail'])
        ->add('nom', TextType::class, ['label' => 'Nom'])
        ->add('prenom', TextType::class,['label' => 'Prénom'])
        ->add('adresse', TextType::class, ['label' => 'Adresse'])
        ->add('ville', TextType::class, ['label' => 'Ville'])
        ->add('cp', TextType::class, ['label' => 'Code Postal'])
        ->add('url', FileType::class , array('data_class' => null))
        ->add('dateNaissance')
        ->add('genre')
        ->add('telephone')
        ->add('biographie')
        ->add('save', SubmitType::class, [
            'attr' => ['class' => 'btn-edit-profile'],
        ]);        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
