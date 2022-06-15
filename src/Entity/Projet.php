<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $gitlink;

    #[ORM\Column(type: 'string', length: 255)]
    private $projectlink;

    #[ORM\Column(type: 'string', length: 255)]
    private $imageprojet;

    #[ORM\Column(type: 'datetime')]
    private $datetime;

    #[ORM\OneToMany(mappedBy: 'projet', targetEntity: User::class)]
    private $user;

    public function __construct()
    {
        $this->user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getGitlink(): ?string
    {
        return $this->gitlink;
    }

    public function setGitlink(string $gitlink): self
    {
        $this->gitlink = $gitlink;

        return $this;
    }

    public function getProjectlink(): ?string
    {
        return $this->projectlink;
    }

    public function setProjectlink(string $projectlink): self
    {
        $this->projectlink = $projectlink;

        return $this;
    }

    public function getImageprojet(): ?string
    {
        return $this->imageprojet;
    }

    public function setImageprojet(string $imageprojet): self
    {
        $this->imageprojet = $imageprojet;

        return $this;
    }

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
            $user->setProjet($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getProjet() === $this) {
                $user->setProjet(null);
            }
        }

        return $this;
    }
}
