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

use App\Domain\Builders\Interfaces\ArticleBuilderInterface;
use App\Domain\Model\Article;

/**
 * Class ArticleBuilder
 */
class ArticleBuilder implements ArticleBuilderInterface
{
    /** @var Article */
    private $article;

    /**
     * {@inheritdoc}
     */
    public function create(
        string $title,
        string $content
    ): ArticleBuilderInterface {
        $this->article = new Article($title, $content);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getArticle(): Article
    {
        return $this->article;
    }

}