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
use App\Application\Handlers\Interfaces\Request\Article\AddArticleRequestHandlerInterface;
use App\Application\Helpers\Common\BuildValidationErrorsHelper;
use App\Domain\DTO\Article\NewArticleDTO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class AddArticleRequestHandler
 */
class AddArticleRequestHandler implements AddArticleRequestHandlerInterface
{
    /** @var ValidatorInterface */
    private $validator;

    /** @var SerializerInterface */
    private $serializer;

    /**
     * {@inheritdoc}
     */
    public function __construct(
        ValidatorInterface $validator,
        SerializerInterface $serializer
    ) {
        $this->validator = $validator;
        $this->serializer = $serializer;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(Request $request)
    {
        $object = $this->serializer->deserialize($request->getContent(), NewArticleDTO::class, 'json');
        if (count($this->validator->validate($object)) > 0) {
            throw new WebserviceHttpException(
                Response::HTTP_BAD_REQUEST,
                BuildValidationErrorsHelper::buildError($this->validator->validate($object))
            );
        }

        return $object;
    }
}