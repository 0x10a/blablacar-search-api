<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class BlaBlaCarForm extends AbstractType
{
    //Form builder
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //Departure city
            ->add('departureCity',TextType::class,['label' => 'Departure City']);
    }

}
