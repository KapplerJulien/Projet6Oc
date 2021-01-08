<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('PseudoUtilisateur', TextType::class, [
                'attr' => [
                    'class' => 'fadeIn second',
                    'placeholder' => 'Pseudo',
                ],
                'label' => false,
            ])
            ->add('MdpUtilisateur', TextType::class, [
                'attr' => [
                    'class' => 'fadeIn third',
                    'placeholder' => 'Mot de passe',
                ],
                'label' => false,
            ])
            ->add('SeConnecter', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
