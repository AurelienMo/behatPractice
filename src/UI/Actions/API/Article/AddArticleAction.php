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

use App\Application\Handlers\Interfaces\Request\Article\AddArticleRequestHandlerInterface;
use App\Domain\Builders\Interfaces\ArticleBuilderInterface;
use App\UI\Actions\Interfaces\API\Article\AddArticleActionInterface;
use App\UI\Responders\Interfaces\API\Article\AddArticleResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AddArticleAction
 */
class AddArticleAction implements AddArticleActionInterface
{
    /** @var AddArticleRequestHandlerInterface */
    private $requestHandler;

    /** @var ArticleBuilderInterface */
    private $articleBuilder;

    /** @var AddArticleResponderInterface */
    private $responder;

    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * AddArticleAction constructor.
     *
     * @param AddArticleRequestHandlerInterface $requestHandler
     * @param ArticleBuilderInterface           $articleBuilder
     * @param AddArticleResponderInterface      $responder
     * @param EntityManagerInterface            $entityManager
     */
    public function __construct(
        AddArticleRequestHandlerInterface $requestHandler,
        ArticleBuilderInterface $articleBuilder,
        AddArticleResponderInterface $responder,
        EntityManagerInterface $entityManager
    ) {
        $this->requestHandler = $requestHandler;
        $this->articleBuilder = $articleBuilder;
        $this->responder = $responder;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/api/articles", name="add_article", methods={"POST"})
     *
     * {@inheritdoc}
     */
    public function add(Request $request): Response
    {
        $dto = $this->requestHandler->handle($request);
        $article = $this->articleBuilder->create($dto->title, $dto->content);

        $this->entityManager->persist($article->getArticle());
        $this->entityManager->flush();

        return $this->responder->response($article->getArticle()->getId()->toString());
    }
}