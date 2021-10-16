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
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('password', RepeatedType::class, array(
            'type' => PasswordType::class,
            'first_options'  => array('label' => 'Mot de Passe'),
            'second_options' => array('label' => 'Confirmez votre Mot de Passe'),
        ))
        ->add('email', EmailType::class , ['label' => 'Adresse E-Mail'])
        ->add('nom', TextType::class, ['label' => 'Nom'])
        ->add('prenom', TextType::class,['label' => 'Prénom'])
        ->add('adresse', TextType::class, ['label' => 'Adresse'])
        ->add('ville', TextType::class, ['label' => 'Ville'])
        ->add('cp', TextType::class, ['label' => 'Code Postal'])
        ->add('dateNaissance', DateType::class, [
            'widget' => 'single_text',
            'format' => 'dd/MM/yyyy',
            // prevents rendering it as type="date", to avoid HTML5 date pickers
            'html5' => false,
            'attr' => ['class' => 'calendate']])

            // adds a class that can be selected in JavaScript)
        ->add('genre', ChoiceType::class, [
            'choices'  => [
                'Homme' => "Homme",
                'Femme' => "Femme",

            ],
            'multiple' => false,
            'expanded' => true])
        ->add('telephone')
        ->add('biographie')
        ->add("Validez", SubmitType::class, [
            'attr' => ['class' => 'btn btn-primary m-5 stripe-button'],
        ]);        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
