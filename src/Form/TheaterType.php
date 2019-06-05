<?php

namespace App\Form;

use App\Entity\Theater;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TheaterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('email')
            ->add('address1')
            ->add('address2')
            ->add('zipCode')
            ->add('city')
            ->add('phoneNumber')
            ->add('logo')
            ->add('website')
            ->add('baseRate')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Theater::class,
        ]);
    }
}
