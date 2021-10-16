<?php

namespace App\Form;

use App\Entity\Propriete;
use App\Entity\TypeHabitat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProprieteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('type', ChoiceType::class,  [
                'choices'  => [
                    'Chaîne de caractère' => 'chaine',
                    'Entier' => 'entier',
                    'Décimal' => "decimal",
                ]])
            ->add('obligatoire', CheckboxType::class  , array('required' => false , 'data' => true))
            ->add('idTypeHabitat',EntityType::class, [
                'class' => TypeHabitat::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => 'Nom',
            
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('save', SubmitType::class, ['label' => 'Valider'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Propriete::class,
        ]);
    }
}
