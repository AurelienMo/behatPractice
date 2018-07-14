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

namespace App\UI\Responders\Interfaces\API\Article;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface GetArticleResponderInterface
 */
interface GetArticleResponderInterface
{
    /**
     * @param null|string $datas
     * @param int         $statusCode
     *
     * @return JsonResponse
     */
    public function response(Request $request, ?string $datas = '', int $statusCode = Response::HTTP_OK): Response;
}