<?php

namespace App\Form;

use App\Entity\Occupant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OccupantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type',  ChoiceType::class, [
                'choices' => [
                    'Bébé' => "Bébé",
                    'Enfant' => "Enfant",
                    'Adulte' => "Adulte"
                    ,]
                                        
                    
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Occupant::class,
        ]);
    }
}
