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

namespace App\UI\Responders\API\Article;

use App\UI\Responders\Interfaces\API\Article\GetArticleResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GetArticleResponder
 */
class GetArticleResponder implements GetArticleResponderInterface
{
    /**
     * @param Request     $request
     * @param null|string $datas
     * @param int         $statusCode
     *
     * @return Response
     */
    public function response(Request $request, ?string $datas = '', int $statusCode = Response::HTTP_OK): Response
    {
        $response = new Response(
            $datas,
            $statusCode,
            [
                'Content-Type' => 'application/json',
            ]
        );
        $response->setEtag(md5($response->getContent()));
        $response->setPublic();
        $response->isNotModified($request);

        return $response;
    }

}