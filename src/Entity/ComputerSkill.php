<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ComputerSkillRepository;

#[ORM\Entity(repositoryClass: ComputerSkillRepository::class)]
class ComputerSkill
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 50)]
    private ?string $level = null; // Beginner, Intermediate, Advanced, Expert

    #[ORM\ManyToOne(inversedBy: 'computerSkills')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cv $cv = null;

    // Getters and setters...
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

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(string $level): static
    {
        $this->level = $level;
        return $this;
    }

    public function getCv(): ?Cv
    {
        return $this->cv;
    }

    public function setCv(?Cv $cv): static
    {
        $this->cv = $cv;
        return $this;
    }
}