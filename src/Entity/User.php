<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    /**
     * @var Collection<int, Demande>
     */
    #[ORM\OneToMany(targetEntity: Demande::class, mappedBy: 'recruteur')]
    private Collection $demandesRec;

    /**
     * @var Collection<int, Demande>
     */
    #[ORM\OneToMany(targetEntity: Demande::class, mappedBy: 'candidat')]
    private Collection $demandesCand;

    public function __construct()
    {
        $this->demandesRec = new ArrayCollection();
        $this->demandesCand = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Demande>
     */
    public function getDemandesRec(): Collection
    {
        return $this->demandesRec;
    }

    public function addDemandesRec(Demande $demandesRec): static
    {
        if (!$this->demandesRec->contains($demandesRec)) {
            $this->demandesRec->add($demandesRec);
            $demandesRec->setRecruteur($this);
        }

        return $this;
    }

    public function removeDemandesRec(Demande $demandesRec): static
    {
        if ($this->demandesRec->removeElement($demandesRec)) {
            // set the owning side to null (unless already changed)
            if ($demandesRec->getRecruteur() === $this) {
                $demandesRec->setRecruteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Demande>
     */
    public function getDemandesCand(): Collection
    {
        return $this->demandesCand;
    }

    public function addDemandesCand(Demande $demandesCand): static
    {
        if (!$this->demandesCand->contains($demandesCand)) {
            $this->demandesCand->add($demandesCand);
            $demandesCand->setCandidat($this);
        }

        return $this;
    }

    public function removeDemandesCand(Demande $demandesCand): static
    {
        if ($this->demandesCand->removeElement($demandesCand)) {
            // set the owning side to null (unless already changed)
            if ($demandesCand->getCandidat() === $this) {
                $demandesCand->setCandidat(null);
            }
        }

        return $this;
    }



}
