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

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Interface AddArticleResponderInterface
 */
interface AddArticleResponderInterface
{
    /**
     * AddArticleResponderInterface constructor.
     *
     * @param UrlGeneratorInterface $generator
     */
    public function __construct(
        UrlGeneratorInterface $generator
    );
    
    /**
     * @param string $articleSlug
     *
     * @return Response
     */
    public function response(string $articleSlug): Response;
}