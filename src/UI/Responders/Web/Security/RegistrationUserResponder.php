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

namespace App\UI\Responders\Web\Security;

use App\UI\Responders\Interfaces\Web\Security\RegistrationUserResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class RegistrationUserResponder
 */
class RegistrationUserResponder implements RegistrationUserResponderInterface
{
    /** @var Environment */
    private $templating;

    /** @var UrlGeneratorInterface */
    private $urlGenerator;

    /**
     * RegistrationUserResponder constructor.
     *
     * @param Environment           $templating
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        Environment $templating,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->templating = $templating;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @param bool               $isRedirect
     * @param FormInterface|null $form
     *
     * @return Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function response(bool $isRedirect, FormInterface $form = null): Response
    {
        return $isRedirect ?
            new RedirectResponse($this->urlGenerator->generate('registration')) :
            new Response(
                $this->templating->render('security/registration.html.twig', [
                    'form' => $form->createView()
                ])
            );
    }
}