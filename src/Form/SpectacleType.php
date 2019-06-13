<?php

namespace App\Form;

use App\Entity\Spectacle;
use Symfony\Component\Form\AbstractType;
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
            ->add('baseRate');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Spectacle::class,
        ]);
    }
}
