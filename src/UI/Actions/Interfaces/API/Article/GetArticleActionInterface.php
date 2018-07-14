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

namespace App\UI\Actions\Interfaces\API\Article;

use App\Application\Handlers\Interfaces\Request\Article\GetArticleRequestHandlerInterface;
use App\UI\Responders\Interfaces\API\Article\GetArticleResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Interface GetArticleActionInterface
 */
interface GetArticleActionInterface
{
    /**
     * GetArticleActionInterface constructor.
     *
     * @param GetArticleRequestHandlerInterface $requestHandler
     * @param SerializerInterface               $serializer
     * @param GetArticleResponderInterface      $responder
     */
    public function __construct(
        GetArticleRequestHandlerInterface $requestHandler,
        SerializerInterface $serializer,
        GetArticleResponderInterface $responder
    );

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function show(Request $request): Response;
}