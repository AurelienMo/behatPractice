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

namespace App\Domain\Builders\Interfaces;

use App\Domain\DTO\Interfaces\Security\RegistrationUserDTOInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Interface UserBuilderInterface
 */
interface UserBuilderInterface
{
    /**
     * UserBuilderInterface constructor.
     *
     * @param EncoderFactoryInterface $encoder
     */
    public function __construct(EncoderFactoryInterface $encoder);

    /**
     * @return UserInterface
     */
    public function getUser(): UserInterface;

    /**
     * @param RegistrationUserDTOInterface $dto
     *
     * @return UserBuilderInterface
     */
    public function create(RegistrationUserDTOInterface $dto);
}