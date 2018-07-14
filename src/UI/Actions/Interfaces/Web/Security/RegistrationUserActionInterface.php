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

namespace App\UI\Actions\Interfaces\Web\Security;

use App\Application\Handlers\Interfaces\Forms\RegistrationUserHandlerInterface;
use App\UI\Responders\Interfaces\Web\Security\RegistrationUserResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface RegistrationUserActionInterface
 */
interface RegistrationUserActionInterface
{
    /**
     * RegistrationUserActionInterface constructor.
     *
     * @param RegistrationUserHandlerInterface   $formHandler
     * @param FormFactoryInterface               $formFactory
     * @param RegistrationUserResponderInterface $responder
     */
    public function __construct(
        RegistrationUserHandlerInterface $formHandler,
        FormFactoryInterface $formFactory,
        RegistrationUserResponderInterface $responder
    );

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function register(Request $request): Response;
}