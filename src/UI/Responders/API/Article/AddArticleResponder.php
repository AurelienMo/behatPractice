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

use App\UI\Responders\Interfaces\API\Article\AddArticleResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class AddArticleResponder
 */
class AddArticleResponder implements AddArticleResponderInterface
{
    /** @var UrlGeneratorInterface */
    private $generator;
    
    /**
     * {@inheritdoc}
     */
    public function __construct(
        UrlGeneratorInterface $generator
    ) {
        $this->generator = $generator;
    }
    
    /**
     * @param string $articleSlug
     *
     * @return Response
     */
    public function response(string $articleSlug): Response
    {
        return new Response(
            '',
            Response::HTTP_CREATED,
            [
                'Location' => $this->generator->generate('get_article', ['slug' => $articleSlug]),
            ]
        );
    }
}