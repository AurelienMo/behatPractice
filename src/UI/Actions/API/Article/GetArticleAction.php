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

namespace App\UI\Actions\API\Article;

use App\Application\Exceptions\WebserviceHttpException;
use App\Application\Handlers\Interfaces\Request\Article\GetArticleRequestHandlerInterface;
use App\UI\Actions\Interfaces\API\Article\GetArticleActionInterface;
use App\UI\Responders\Interfaces\API\Article\GetArticleResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class GetArticleAction
 */
class GetArticleAction implements GetArticleActionInterface
{
    /** @var GetArticleRequestHandlerInterface */
    private $requestHandler;

    /** @var SerializerInterface */
    private $serializer;

    /** @var GetArticleResponderInterface */
    private $responder;

    /**
     * GetArticleAction constructor.
     *
     * @param GetArticleRequestHandlerInterface $requestHandler
     * @param SerializerInterface               $serializer
     * @param GetArticleResponderInterface      $responder
     */
    public function __construct(
        GetArticleRequestHandlerInterface $requestHandler,
        SerializerInterface $serializer,
        GetArticleResponderInterface $responder
    ) {
        $this->requestHandler = $requestHandler;
        $this->serializer = $serializer;
        $this->responder = $responder;
    }


    /**
     * @Route("/api/articles/{slug}", name="get_article", methods={"GET"})
     *
     * @param Request $request
     *
     * @return Response
     *
     * @throws WebserviceHttpException
     */
    public function show(Request $request): Response
    {
        $article = $this->requestHandler->handle($request);

        try {
            return $this->responder->response(
                $request,
                $this->serializer->serialize($article, 'json', ['groups' => ['show']])
            );
        } catch (\Exception $e) {
            throw new WebserviceHttpException(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                $e->getMessage()
            );
        }

    }
}