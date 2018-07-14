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

namespace App\Application\Listeners;

use App\Application\Exceptions\WebserviceHttpException;
use App\Application\Listeners\Interfaces\WebserviceExceptionListenerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class WebserviceExceptionListener
 */
class WebserviceExceptionListener implements WebserviceExceptionListenerInterface
{
    /**
     * {@inheritdoc}
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();
        $response = new JsonResponse();

        if ($exception instanceof WebserviceHttpException) {
            $response->setStatusCode($exception->getStatusCode())
                    ->setData(
                        array_merge(
                            ['code' => $exception->getStatusCode()],
                            ['message' => $exception->getErrors()]
                        )
                    );
        } else if ($exception instanceof NotFoundHttpException) {
            $response->setStatusCode($exception->getStatusCode())
                     ->setData(
                         [
                             'code' => $exception->getStatusCode(),
                             'message' => $exception->getMessage(),
                         ]
                     );
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)
                     ->setData(
                         [
                             'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                             'message' => $exception->getMessage(),
                         ]
                     );
        }
        $event->setResponse($response);
    }
}