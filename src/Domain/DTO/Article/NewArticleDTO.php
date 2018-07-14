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

namespace App\Domain\DTO\Article;

use App\Domain\DTO\Interfaces\Article\NewArticleDTOInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class NewArticleDTO
 */
class NewArticleDTO implements NewArticleDTOInterface
{
    /**
     * @var null|string
     *
     * @Assert\NotBlank(
     *     message="Le titre est requis pour créer un article."
     * )
     */
    public $title;

    /**
     * @var null|string
     *
     * @Assert\NotBlank(
     *     message="Le contenu est requis pour créer un article."
     * )
     */
    public $content;

    /**
     * NewArticleDTO constructor.
     *
     * @param null|string $title
     * @param null|string $content
     */
    public function __construct(
        ?string $title = '',
        ?string $content = ''
    ) {
        $this->title = $title;
        $this->content = $content;
    }


}