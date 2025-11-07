<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class LanguageSkill
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $language = null;

    #[ORM\Column(length: 50)]
    private ?string $level = null;

    #[ORM\ManyToOne(inversedBy: 'languageSkills')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cv $cv = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language): static
    {
        $this->language = $language;
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