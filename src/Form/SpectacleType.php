<?php

namespace App\Form;

use App\Entity\ShowDate;
use App\Entity\Spectacle;
use DateTimeInterface;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class SpectacleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add(
                'description',
                TextareaType::class,
                ['required'=>true]
            )
            ->add(
                'distribution',
                TextareaType::class,
                ['required'=>true]
            )
            ->add(
                'mandatoryInfos',
                TextareaType::class,
                ['required'=>false]
            )
            ->add(
                'image',
                FileType::class,
                ['required'=>false,
                    'help' => 'fichier photo au format : png',
                'data_class' => null]
            )
            ->add('photoCredits')
            ->add(
                'additionalInfos',
                TextareaType::class,
                ['required'=>false]
            )

            ->add('isBalise', null, ['label'=>'Enregistrement Offres Balises'])
            ->add(
                'offerType',
                ChoiceType::class,
                ['required'=>false,
                    'choices'=> ['Une Place Achetée -> Une Place Offerte' => 1 , 'Tarif Réduit'=>2],
                'preferred_choices' => [1]]
            )
            ->add(
                'mapadoLink',
                UrlType::class,
                ['required'=>false]
            )
            ->add('baseRate', MoneyType::class, ['required'=>false]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Spectacle::class,
        ]);
    }
}
