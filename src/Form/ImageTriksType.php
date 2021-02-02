<?php

namespace App\Form;

use App\Entity\ImageTriks;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageTriksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           ->add('imageTriks', CollectionType::class, [
                'entry_type' => ImageTriksType::class,
                'allow_add' => true,
                'label' => false,
                'mapped' => false,
            ])
            ->add('Article')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ImageTriks::class,
        ]);
    }
}
