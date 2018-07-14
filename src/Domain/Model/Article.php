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

namespace App\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="App\Domain\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @var UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid")
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     *
     * @Groups({"show"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     *
     * @Groups({"show"})
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     *
     * @Groups({"show"})
     */
    private $createdAt;

    /**
     * Article constructor.
     *
     * @param string $title
     * @param string $content
     */
    public function __construct(
        string $title,
        string $content
    ) {
        $this->title = $title;
        $this->content = $content;
        $this->createdAt = new \DateTime();
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
}