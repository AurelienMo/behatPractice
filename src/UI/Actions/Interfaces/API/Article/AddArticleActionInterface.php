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

use App\Application\Exceptions\WebserviceHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface AddArticleActionInterface
 */
interface AddArticleActionInterface
{
    /**
     * @param Request $request
     *
     * @return Response
     *
     * @throws WebserviceHttpException
     */
    public function add(Request $request): Response;
}