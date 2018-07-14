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

namespace App\UI\Actions\Web\Security;

use App\Application\Handlers\Interfaces\Forms\RegistrationUserHandlerInterface;
use App\UI\Actions\Interfaces\Web\Security\RegistrationUserActionInterface;
use App\UI\Forms\RegistrationUserType;
use App\UI\Responders\Interfaces\Web\Security\RegistrationUserResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RegistrationUserAction
 */
class RegistrationUserAction implements RegistrationUserActionInterface
{
    /** @var RegistrationUserHandlerInterface */
    private $formHandler;

    /** @var FormFactoryInterface */
    private $formFactory;

    /** @var RegistrationUserResponderInterface */
    private $responder;

    /**
     * {@inheritdoc}
     */
    public function __construct(
        RegistrationUserHandlerInterface $formHandler,
        FormFactoryInterface $formFactory,
        RegistrationUserResponderInterface $responder
    ) {
        $this->formHandler = $formHandler;
        $this->formFactory = $formFactory;
        $this->responder = $responder;
    }

    /**
     * {@inheritdoc}
     *
     * @Route("/register", name="registration")
     */
    public function register(Request $request): Response
    {
        $form = $this->formFactory->create(RegistrationUserType::class)
                                  ->handleRequest($request);

        if ($this->formHandler->handle($form)) {
            return $this->responder->response(true);
        }

        return $this->responder->response(false, $form);
    }
}