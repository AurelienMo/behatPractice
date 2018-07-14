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

namespace App\Domain\Builders;

use App\Domain\Builders\Interfaces\UserBuilderInterface;
use App\Domain\DTO\Interfaces\Security\RegistrationUserDTOInterface;
use App\Domain\Model\User;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class UserBuilder
 */
class UserBuilder implements UserBuilderInterface
{
    /** @var EncoderFactoryInterface */
    private $encoder;

    /** @var UserInterface */
    private $user;

    /**
     * UserBuilder constructor.
     *
     * @param EncoderFactoryInterface $encoder
     */
    public function __construct(
        EncoderFactoryInterface $encoder
    ) {
        $this->encoder = $encoder;
    }

    /**
     * @return UserInterface
     */
    public function getUser(): UserInterface
    {
        return $this->user;
    }

    /**
     * @param RegistrationUserDTOInterface $dto
     *
     * @return $this|UserBuilderInterface
     */
    public function create(RegistrationUserDTOInterface $dto)
    {
        $this->user = new User(
            $dto->username,
            $dto->email,
            ($this->encoder->getEncoder(User::class))->encodePassword($dto->password, '')
        );

        return $this;
    }
}