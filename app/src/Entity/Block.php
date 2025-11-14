<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\BlockRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: BlockRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection()
    ]
)]
class Block
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['article:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(['article:read'])]
    private ?string $type = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    #[Groups(['article:read'])]
    private ?string $content = null;

    #[ORM\Column]
    private ?int $ordering = null;

    #[ORM\ManyToOne(inversedBy: 'blocks')]
    private ?Article $article = null;

    #[ORM\ManyToOne(inversedBy: 'blocks')]
    #[Groups(['article:read'])]
    private ?DataSet $dataSet = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getOrdering(): ?int
    {
        return $this->ordering;
    }

    public function setOrdering(int $ordering): static
    {
        $this->ordering = $ordering;

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): static
    {
        $this->article = $article;

        return $this;
    }

    public function getDataSet(): ?DataSet
    {
        return $this->dataSet;
    }

    public function setDataSet(?DataSet $dataSet): static
    {
        $this->dataSet = $dataSet;

        return $this;
    }
}
