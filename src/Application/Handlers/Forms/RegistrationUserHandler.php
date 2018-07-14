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

namespace App\Application\Handlers\Forms;

use App\Application\Handlers\Interfaces\Forms\RegistrationUserHandlerInterface;
use App\Domain\Builders\Interfaces\UserBuilderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class RegistrationUserHandler
 */
class RegistrationUserHandler implements RegistrationUserHandlerInterface
{
    /** @var UserBuilderInterface */
    private $userBuilder;

    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var SessionInterface */
    private $session;

    /**
     * RegistrationUserHandler constructor.
     *
     * @param UserBuilderInterface   $userBuilder
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        UserBuilderInterface $userBuilder, EntityManagerInterface $entityManager,
        SessionInterface $session
    )
    {
        $this->userBuilder = $userBuilder;
        $this->entityManager = $entityManager;
        $this->session = $session;
    }

    /**
     * @param FormInterface $form
     *
     * @return bool
     */
    public function handle(FormInterface $form): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $user = ($this->userBuilder->create($form->getData()))
                                       ->getUser();


            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $this->session->getFlashbag()->add('success', 'Votre inscription a été prise en compte.');

            return true;
        }

        return false;
    }
}