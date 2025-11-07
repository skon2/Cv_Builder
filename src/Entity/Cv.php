<?php

namespace App\Entity;

use App\Repository\CvRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: CvRepository::class)]
#[Vich\Uploadable]
class Cv
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $fullName = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $summary = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[Vich\UploadableField(mapping: 'cv_photos', fileNameProperty: 'photoName')]
    private ?File $photoFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $photoName = null;

    #[ORM\Column(length: 50)]
    private ?string $template = 'classic';

    #[ORM\OneToMany(mappedBy: 'cv', targetEntity: Education::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $educations;

    #[ORM\OneToMany(mappedBy: 'cv', targetEntity: Experience::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $experiences;

    #[ORM\OneToMany(mappedBy: 'cv', targetEntity: LanguageSkill::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $languageSkills;

    #[ORM\OneToMany(mappedBy: 'cv', targetEntity: Project::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $projects;

    #[ORM\OneToMany(mappedBy: 'cv', targetEntity: SocialActivity::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $socialActivities;

    #[ORM\OneToMany(mappedBy: 'cv', targetEntity: ComputerSkill::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $computerSkills;

    public function __construct()
    {
        $this->educations = new ArrayCollection();
        $this->experiences = new ArrayCollection();
        $this->languageSkills = new ArrayCollection();
        $this->projects = new ArrayCollection();
        $this->socialActivities = new ArrayCollection();
        $this->computerSkills = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): static
    {
        $this->fullName = $fullName;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;
        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;
        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): static
    {
        $this->summary = $summary;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function setPhotoFile(?File $photoFile = null): void
    {
        $this->photoFile = $photoFile;

        if (null !== $photoFile) {
            $this->createdAt = new \DateTimeImmutable();
        }
    }

    public function getPhotoFile(): ?File
    {
        return $this->photoFile;
    }

    public function setPhotoName(?string $photoName): void
    {
        $this->photoName = $photoName;
    }

    public function getPhotoName(): ?string
    {
        return $this->photoName;
    }

    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function setTemplate(string $template): static
    {
        $this->template = $template;
        return $this;
    }

    public function getEducations(): Collection
    {
        return $this->educations;
    }

    public function addEducation(Education $education): static
    {
        if (!$this->educations->contains($education)) {
            $this->educations->add($education);
            $education->setCv($this);
        }
        return $this;
    }

    public function removeEducation(Education $education): static
    {
        if ($this->educations->removeElement($education)) {
            if ($education->getCv() === $this) {
                $education->setCv(null);
            }
        }
        return $this;
    }

    public function getExperiences(): Collection
    {
        return $this->experiences;
    }

    public function addExperience(Experience $experience): static
    {
        if (!$this->experiences->contains($experience)) {
            $this->experiences->add($experience);
            $experience->setCv($this);
        }
        return $this;
    }

    public function removeExperience(Experience $experience): static
    {
        if ($this->experiences->removeElement($experience)) {
            if ($experience->getCv() === $this) {
                $experience->setCv(null);
            }
        }
        return $this;
    }

    public function getLanguageSkills(): Collection
    {
        return $this->languageSkills;
    }

    public function addLanguageSkill(LanguageSkill $languageSkill): static
    {
        if (!$this->languageSkills->contains($languageSkill)) {
            $this->languageSkills->add($languageSkill);
            $languageSkill->setCv($this);
        }
        return $this;
    }

    public function removeLanguageSkill(LanguageSkill $languageSkill): static
    {
        if ($this->languageSkills->removeElement($languageSkill)) {
            if ($languageSkill->getCv() === $this) {
                $languageSkill->setCv(null);
            }
        }
        return $this;
    }

    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): static
    {
        if (!$this->projects->contains($project)) {
            $this->projects->add($project);
            $project->setCv($this);
        }
        return $this;
    }

    public function removeProject(Project $project): static
    {
        if ($this->projects->removeElement($project)) {
            if ($project->getCv() === $this) {
                $project->setCv(null);
            }
        }
        return $this;
    }

    public function getSocialActivities(): Collection
    {
        return $this->socialActivities;
    }

    public function addSocialActivity(SocialActivity $socialActivity): static
    {
        if (!$this->socialActivities->contains($socialActivity)) {
            $this->socialActivities->add($socialActivity);
            $socialActivity->setCv($this);
        }
        return $this;
    }

    public function removeSocialActivity(SocialActivity $socialActivity): static
    {
        if ($this->socialActivities->removeElement($socialActivity)) {
            if ($socialActivity->getCv() === $this) {
                $socialActivity->setCv(null);
            }
        }
        return $this;
    }

    public function getComputerSkills(): Collection
    {
        return $this->computerSkills;
    }

    public function addComputerSkill(ComputerSkill $computerSkill): static
    {
        if (!$this->computerSkills->contains($computerSkill)) {
            $this->computerSkills->add($computerSkill);
            $computerSkill->setCv($this);
        }
        return $this;
    }

    public function removeComputerSkill(ComputerSkill $computerSkill): static
    {
        if ($this->computerSkills->removeElement($computerSkill)) {
            if ($computerSkill->getCv() === $this) {
                $computerSkill->setCv(null);
            }
        }
        return $this;
    }
}