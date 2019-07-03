<?php

namespace App\Form;

use App\Entity\ShowDate;
use App\Entity\ShowRate;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Twig\Extensions\TextExtension;

class ShowDateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateShow')
            //->add('showId')
            //->add('showRate', EntityType::Class,['class'=> ShowRate::Class ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ShowDate::class,
        ]);
    }
}
