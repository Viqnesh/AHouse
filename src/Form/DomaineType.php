<?php

namespace App\Form;

use App\Entity\Domaine;
use App\Entity\Region ;
use App\Entity\Equipement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType; 



class DomaineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('description', TextareaType::class)
            ->add('image', FileType::class, array('data_class' => null))
            ->add('arrive', TimeType::class, [
                'input'  => 'datetime',
                'widget' => 'single_text',
            ])
            ->add('depart', TimeType::class, [
                'input' => 'datetime',
                'widget' => 'single_text',
            ])
            ->add('adresse')
            ->add('ville')
            ->add('region', EntityType::class, [
                // looks for choices from this entity
                'class' => Region::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => 'Nom',
            
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('equipement', EntityType::class, [
                // looks for choices from this entity
                'class' => Equipement::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => 'Nom',
            
                // used to render a select box, check boxes or radios
                'multiple' => true,
                'expanded' => true,
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
            'data_class' => Domaine::class,
        ]);
    }
}
