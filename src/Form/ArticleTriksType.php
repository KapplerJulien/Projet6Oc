<?php

namespace App\Form;

use App\Entity\ArticleTriks;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\GroupeTriks;

class ArticleTriksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NomArtTriks')
            ->add('ContenuArtTriks')
            ->add('DateCreationArtTriks')
            ->add('DateDerniereModificationArtTriks')
            ->add('imageTriks', CollectionType::class, [
                'entry_type' => FileType::class,
                'allow_add' => 'true',
                'label' => false,
                'mapped' => false,
                'required' => false,
            ])
            ->add('videoTriks', CollectionType::class, [
                'entry_type' => TextType::class,
                'allow_add' => 'true',
                'label' => false,
                'mapped' => false,
                'required' => false,
            ])
            ->add('Groupe',EntityType::class,[
                'class' => GroupeTriks::class,
                'choice_label' => function ($group) {
                    return $group->getNomGrpTriks();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ArticleTriks::class,
        ]);
    }
}
