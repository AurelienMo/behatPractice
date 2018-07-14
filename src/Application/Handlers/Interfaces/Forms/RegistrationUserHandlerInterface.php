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

namespace App\Application\Handlers\Interfaces\Forms;

use Symfony\Component\Form\FormInterface;

/**
 * Interface RegistrationUserHandlerInterface
 */
interface RegistrationUserHandlerInterface
{
    /**
     * @param FormInterface $form
     *
     * @return bool
     */
    public function handle(FormInterface $form): bool;
}