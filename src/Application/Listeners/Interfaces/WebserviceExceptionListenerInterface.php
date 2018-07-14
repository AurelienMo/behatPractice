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

namespace App\Application\Listeners\Interfaces;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

/**
 * Interface WebserviceExceptionListenerInterface
 */
interface WebserviceExceptionListenerInterface
{
    /**
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event);
}