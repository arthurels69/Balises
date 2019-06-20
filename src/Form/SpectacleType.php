<?php

namespace App\Form;

use App\Entity\ShowDate;
use App\Entity\Spectacle;
use DateTimeInterface;
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
use Symfony\Component\Form\Extension\Core\Type\FileType;

class SpectacleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add(
                'description',
                TextType::class,
                ['required'=>false]
            )
            ->add('distribution')
            ->add('mandatoryInfos')
            ->add(
                'image',
                FileType::class,
                ['required'=>false,
                    'help' => 'fichier photo au format : png',
                'data_class' => null]
            )
            ->add('photoCredits')
            ->add('additionalInfos')
            ->add('isBalise')
            ->add('offerType')
            ->add(
                'mapadoLink',
                UrlType::class,
                ['required'=>false]
            )
            ->add('baseRate', MoneyType::class, ['required'=>false])
            ->add('showDates', CollectionType::class, [
                'entry_type' => ShowDateType::class,
                'entry_options' => ['label' => false],
                'allow_add'    => true,
            ]);
    }
}
