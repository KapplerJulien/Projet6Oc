<?php

namespace App\Form;

use App\Entity\ArticleTriks;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\GroupeTriks;

class ArticleTriksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NomArtTriks', TextType::class, [
                'attr' => [
                    'class' => 'fadeIn second',
                    'placeholder' => 'Nom'
                ],
                'label' => false
            ])
            ->add('ContenuArtTriks', TextareaType::class, [
                'attr' => [
                    'class' => 'fadeIn second contenu-article-new',
                    'placeholder' => 'Contenu',
                ],
                'label' => false 
            ])
            ->add('LienImgTriks', CollectionType::class, [
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
            ->add('AjouterArticle', SubmitType::class, [
                'attr' => [
                    'class' => 'btn-user',
                ],
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
