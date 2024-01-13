<?php

namespace App\Entity;

use App\Repository\IdeaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IdeaRepository::class)]
class Idea
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Author = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(length: 500)]
    private ?string $ShortDescription = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $LongDescription = null;

    #[ORM\Column(nullable: true)]
    private ?int $Votes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?string
    {
        return $this->Author;
    }

    public function setAuthor(string $Author): static
    {
        $this->Author = $Author;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->ShortDescription;
    }

    public function setShortDescription(string $ShortDescription): static
    {
        $this->ShortDescription = $ShortDescription;

        return $this;
    }

    public function getLongDescription(): ?string
    {
        return $this->LongDescription;
    }

    public function setLongDescription(?string $LongDescription): static
    {
        $this->LongDescription = $LongDescription;

        return $this;
    }

    public function getVotes(): ?int
    {
        return $this->Votes;
    }

    public function setVotes(?int $Votes): static
    {
        $this->Votes = $Votes;

        return $this;
    }
}
