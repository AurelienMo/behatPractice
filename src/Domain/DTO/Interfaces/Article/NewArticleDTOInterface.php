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

namespace App\Domain\DTO\Interfaces\Article;

/**
 * Interface NewArticleDTOInterface
 */
interface NewArticleDTOInterface
{
    /**
     * NewArticleDTOInterface constructor.
     *
     * @param null|string $title
     * @param null|string $content
     */
    public function __construct(
        ?string $title,
        ?string $content
    );
}