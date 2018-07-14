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

namespace App\Domain\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;

/**
 * Class ArticleRepository
 */
class ArticleRepository extends EntityRepository
{
    /**
     * @param string $slug
     *
     * @return mixed
     *
     * @throws NonUniqueResultException
     */
    public function getArticleBySlug(string $slug)
    {
        return $this->createQueryBuilder('a')
                   ->where('a.slug = :slug')
                   ->setParameter('slug', $slug)
                   ->setCacheable(true)
                   ->getQuery()
                   ->getOneOrNullResult();
    }
}