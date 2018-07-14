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

namespace App\UI\Responders\Interfaces\Web\Security;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Interface RegistrationUserResponderInterface
 */
interface RegistrationUserResponderInterface
{
    /**
     * RegistrationUserResponderInterface constructor.
     *
     * @param Environment           $templating
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        Environment $templating,
        UrlGeneratorInterface $urlGenerator
    );

    /**
     * @param bool          $isRedirect
     * @param FormInterface $form
     *
     * @return Response
     */
    public function response(bool $isRedirect, FormInterface $form = null): Response;
}