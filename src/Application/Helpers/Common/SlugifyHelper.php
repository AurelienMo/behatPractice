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

/**
 * Class SlugifyHelper
 */
class SlugifyHelper
{
    public static function slugify(string $text)
    {
        $rule = 'NFD; [:Nonspacing Mark:] Remove; NFC';
        $transliterator = \Transliterator::create($rule);
        $string = $transliterator->transliterate($text);

        return preg_replace(
            '/[^a-z0-9]/',
            '-',
            strtolower(trim(strip_tags($string)))
        );
    }
}