<?php

namespace App\Entity;

use App\Repository\DataSetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: DataSetRepository::class)]
#[Vich\Uploadable]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection()
    ],
    normalizationContext: ['groups' => ['dataset:read']]
)]
class DataSet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['article:read', 'dataset:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['article:read', 'dataset:read'])]
    private ?string $name = null;

    #[Vich\UploadableField(mapping: 'dataset_files', fileNameProperty: 'dataFile')]
    private ?File $dataCsvFile = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['article:read', 'dataset:read'])]
    private ?string $dataFile = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'dataSets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    #[ORM\Column(nullable: true)]
    private ?array $schemaDefinition = null;

    /**
     * @var Collection<int, Block>
     */
    #[ORM\OneToMany(targetEntity: Block::class, mappedBy: 'dataSet')]
    private Collection $blocks;

    public function __construct()
    {
        $this->blocks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function setDataCsvFile(?File $dataCsvFile = null): void
    {
        $this->dataCsvFile = $dataCsvFile;

        if (null !== $dataCsvFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getDataCsvFile(): ?File
    {
        return $this->dataCsvFile;
    }

    public function getDataFile(): ?string
    {
        return $this->dataFile;
    }

    public function setDataFile(?string $dataFile): static
    {
        $this->dataFile = $dataFile;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    public function getSchemaDefinition(): ?array
    {
        return $this->schemaDefinition;
    }

    public function setSchemaDefinition(?array $schemaDefinition): static
    {
        $this->schemaDefinition = $schemaDefinition;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name ?? 'Nouveau jeu de données';
    }

    /**
     * @return Collection<int, Block>
     */
    public function getBlocks(): Collection
    {
        return $this->blocks;
    }

    public function addBlock(Block $block): static
    {
        if (!$this->blocks->contains($block)) {
            $this->blocks->add($block);
            $block->setDataSet($this);
        }

        return $this;
    }

    public function removeBlock(Block $block): static
    {
        if ($this->blocks->removeElement($block)) {
            // set the owning side to null (unless already changed)
            if ($block->getDataSet() === $this) {
                $block->setDataSet(null);
            }
        }

        return $this;
    }
}
