<?php

namespace App\Form;

use App\Entity\Theater;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class TheaterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('email', EmailType::class)
            ->add('address1', TextType::class)
            ->add('address2', TextType::class, ['required'=>false])
            ->add(
                'zipCode',
                IntegerType::class,
                ['constraints' =>
                    new Length(
                        [
                        'max' => 5,
                        'maxMessage' => 'code postal max 5 chiffres !'
                        ]
                    ) ]
            )
            ->add('city', TextType::class)
            ->add(
                'phoneNumber',
                TextType::class,
                ['attr' => ['placeholder' => 'XX.XX.XX.XX']]
            )
            ->add('logo')
            ->add('website')
            ->add('baseRate', MoneyType::class, ['required'=>false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Theater::class,
        ]);
    }
}
