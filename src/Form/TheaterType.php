<?php

namespace App\Form;

use App\Entity\Theater;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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
            ->add('zipCode', TextType::class)
            ->add('city', TextType::class)
            ->add(
                'phoneNumber',
                TelType::class,
                ['help'=>'+330102030405 +33 01 02 03 04 05  0102030405, 01-02-03-04-05']
            )
            ->add(
                'logo',
                FileType::class,
                ['help' => 'fichier logo au format : jpg, png, gif',
                    'data_class' => null]
            )
            ->add(
                'website',
                UrlType::class,
                ['help' => 'ex : https:// ou http://']
            )
            ->add('baseRate', MoneyType::class, ['required'=>false])
            ->add('lat', NumberType::class, ['required'=>false])
            ->add('longitude', NumberType::class, ['required'=>false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Theater::class,
        ]);
    }
}
