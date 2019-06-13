<?php

namespace App\Form;

use App\Entity\ShowDate;
use App\Entity\Spectacle;
use DateTimeInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpectacleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('distribution')
            ->add('mandatoryInfos')
            ->add('image')
            ->add('photoCredits')
            ->add('additionalInfos')
            ->add('isBalise')
//            ->add('offerType')
            ->add('mapadoLink')
            ->add('baseRate')
            ->add('showDates', CollectionType::class, [
                'entry_type' => ShowDateType::class,
                'entry_options' => ['label' => false],
                'allow_add'    => true,
            ]);
    }
}
