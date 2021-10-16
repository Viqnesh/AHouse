<?php

namespace App\Form;

use App\Entity\DispoDomaine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use App\Form\CalendarHabitatType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class DispoDomaineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dateDispo', DateType::class, [
            'widget' => 'single_text',
            'format' => 'dd/MM/yyyy',
            // prevents rendering it as type="date", to avoid HTML5 date pickers
            'html5' => false,
            'attr' => ['class' => 'calendate'],

            // adds a class that can be selected in JavaScript
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DispoDomaine::class,
        ]);
    }
}
