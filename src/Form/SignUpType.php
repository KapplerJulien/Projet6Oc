<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class SignUpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'attr' => [
                    'class' => 'fadeIn second',
                    'placeholder' => 'Pseudo',
                ],
                'label' => false,
            ])
            ->add('password', PasswordType::class, [
                'attr' => [
                    'class' => 'fadeIn third',
                    'placeholder' => 'Mot de passe',
                ],
                'label' => false,
            ])
            ->add('MailUtilisateur', EmailType::class,  [
                'attr' => [
                    'class' => 'fadeIn third',
                    'placeholder' => 'Email',
                ],
                'label' => false,
            ])
            ->add('Sinscrire', SubmitType::class,  [
                'label' => "S'inscrire",
                'attr' => [
                    'class' => 'btn-user',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
