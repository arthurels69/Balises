<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('password')
            ->add('confirm_password')
            ->add('theater', TheaterType::class, [
                'label' => false
            ])
            ->get('theater')
                ->remove('email')
                ->remove('address1')
                ->remove('address2')
                ->remove('email')
                ->remove('zipCode')
                ->remove('city')
                ->remove('phoneNumber')
                ->remove('logo')
                ->remove('picture')
                ->remove('website')
                ->remove('baseRate')
                ->remove('lat')
                ->remove('longitude')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
