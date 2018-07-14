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

namespace App\Domain\DTO\Interfaces\Security;

/**
 * Interface RegistrationUserDTOInterface
 */
interface RegistrationUserDTOInterface
{
    /**
     * RegistrationUserDTOInterface constructor.
     *
     * @param null|string $username
     * @param null|string $email
     * @param null|string $password
     */
    public function __construct(
        ?string $username = null,
        ?string $email = null,
        ?string $password = null
    );
}