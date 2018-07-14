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

namespace App\Application\Exceptions;

use Throwable;

/**
 * Class WebserviceHttpException
 */
class WebserviceHttpException extends \Exception
{
    /** @var int */
    private $statusCode;

    /** @var array */
    private $errors;

    /**
     * WebserviceHttpException constructor.
     *
     * @param int            $statusCode
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct(
        int $statusCode,
        array $errors = [],
        string $message = "",
        int $code = 0,
        Throwable $previous = null
    ) {
        $this->statusCode = $statusCode;
        $this->errors = $errors;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}