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

use App\Application\Exceptions\WebserviceHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Interface AddArticleRequestHandlerInterface
 */
interface AddArticleRequestHandlerInterface
{
    /**
     * AddArticleRequestHandlerInterface constructor.
     *
     * @param ValidatorInterface  $validator
     * @param SerializerInterface $serializer
     */
    public function __construct(
        ValidatorInterface $validator,
        SerializerInterface $serializer
    );

    /**
     * @param Request $request
     *
     * @return mixed
     *
     * @throws WebserviceHttpException
     */
    public function handle(Request $request);
}