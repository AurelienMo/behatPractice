<?php

declare(strict_types=1);

/*
 * This file is part of behat
 *
 * (c) Aurelien Morvan <morvan.aurelien@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\UI\Forms;

use App\Domain\DTO\Interfaces\Security\RegistrationUserDTOInterface;
use App\Domain\DTO\Security\RegistrationUserDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class RegistrationUserType
 */
class RegistrationUserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'username',
                TextType::class,
                [
                    'label' => 'Nom d\'utilisateur souhaité',
                    'required' => false,
                ]
            )
            ->add(
                'email',
                TextType::class,
                [
                    'label' => 'Votre email',
                    'required' => false,
                ]
            )
            ->add(
                'password',
                RepeatedType::class,
                [
                    'type' => PasswordType::class,
                    'invalid_message' => 'Les mots de passe doivent être identique',
                    'first_options' => [
                        'label' => 'Mot de passe',
                        'required' => false,
                    ],
                    'second_options' => [
                        'label' => 'Confirmer mot de passe',
                        'required' => false,
                    ],
                    'required' => false,
                ]
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => RegistrationUserDTOInterface::class,
                'empty_data' => function (FormInterface $form) {
                    return new RegistrationUserDTO(
                        $form->get('username')->getData(),
                        $form->get('email')->getData(),
                        $form->get('password')->getData()
                    );
                },
            ]
        );
    }
}