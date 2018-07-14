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

namespace App\Application\Handlers\Request\Article;

use App\Application\Exceptions\WebserviceHttpException;
use App\Application\Handlers\Interfaces\Request\Article\GetArticleRequestHandlerInterface;
use App\Domain\Model\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GetArticleRequestHandler
 */
class GetArticleRequestHandler implements GetArticleRequestHandlerInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * GetArticleRequestHandler constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Request $request
     *
     * @return Article
     *
     * @throws WebserviceHttpException
     */
    public function handle(Request $request)
    {
        $article = $this->entityManager->getRepository(Article::class)
                                       ->getArticleById($request->attributes->get('id'));

        if (!$article) {
            throw new WebserviceHttpException(
                Response::HTTP_NOT_FOUND,
                ['Resource not found']
            );
        }

        return $article;
    }
}