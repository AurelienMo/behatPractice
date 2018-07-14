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

namespace App\Application\Helpers\Common;

use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Class BuildValidationErrorsHelper
 */
class BuildValidationErrorsHelper
{
    /**
     * @param ConstraintViolationListInterface $violationList
     *
     * @return array
     */
    public static function buildError(ConstraintViolationListInterface $violationList): array
    {
        $results = [];
        foreach ($violationList as $violation) {
            $results[$violation->getPropertyPath()][] = $violation->getMessage();
        }

        return $results;
    }
}