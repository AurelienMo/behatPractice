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

namespace App\Domain\DTO\Security;

use App\Domain\DTO\Interfaces\Security\RegistrationUserDTOInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class RegistrationUserDTO
 */
class RegistrationUserDTO implements RegistrationUserDTOInterface
{
    /**
     * @var string
     *
     * @Assert\NotBlank(
     *     message="Le nom d'utilisateur doit être indiqué."
     * )
     * @Assert\Length(
     *     max="80",
     *     maxMessage="Le nombre maximum de caractères pour le nom d'utilisateur est de 80 caractères"
     * )
     */
    public $username;

    /**
     * @var string
     *
     * @Assert\NotBlank(
     *     message="L'adresse email doit être indiquée"
     * )
     * @Assert\Email(
     *     message="L'adresse email doit être au format email"
     * )
     */
    public $email;

    /**
     * @var string
     *
     * @Assert\NotBlank(
     *     message="Le champ mot de passe ne peut être vide."
     * )
     */
    public $password;

    /**
     * RegistrationUserDTO constructor.
     *
     * @param string $username
     * @param string $email
     * @param string $password
     */
    public function __construct(
        ?string $username = null,
        ?string $email = null,
        ?string $password = null
    ) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }


}