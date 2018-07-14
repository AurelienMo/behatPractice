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

namespace App\Application\Handlers\Interfaces\Request\Article;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Interface GetArticleRequestHandlerInterface
 */
interface GetArticleRequestHandlerInterface
{
    /**
     * GetArticleRequestHandlerInterface constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        EntityManagerInterface $entityManager
    );

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function handle(Request $request);
}