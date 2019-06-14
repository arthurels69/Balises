<?php

namespace App\Form;

use App\Entity\ShowDate;
use App\Entity\ShowRate;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShowDateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateShow', DateType::class)
//            ->add('showRate', CollectionType::class, [
//                'entry_type' => ShowRate::class,
//                'entry_options' => ['label' => false],
//                'allow_add'    => true,
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ShowDate::class,
        ]);
    }
}
