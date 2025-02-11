<?php

namespace App\Entity;

use App\Repository\ConducteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConducteurRepository::class)]
class Conducteur extends User
{

    #[ORM\Column(length: 255)]
    private ?string $vehicule = null;

    #[ORM\Column(type: Types::ARRAY,nullable: true)]
    private array $historiqueTrajets = [];

    /**
     * @var Collection<int, Voiture>
     */
    #[ORM\OneToMany(targetEntity: Voiture::class, mappedBy: 'conducteurr')]
    private Collection $voitures;

    public function __construct()
    {
        $this->voitures = new ArrayCollection();
    }

    public function getVehicule(): ?string
    {
        return $this->vehicule;
    }

    public function setVehicule(string $vehicule): static
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    public function getNoteMoyenne(): ?float
    {
        return $this->noteMoyenne;
    }

    public function setNoteMoyenne(float $noteMoyenne): static
    {
        $this->noteMoyenne = $noteMoyenne;

        return $this;
    }

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function setExperience(int $experience): static
    {
        $this->experience = $experience;

        return $this;
    }

    public function getHistoriqueTrajets(): array
    {
        return $this->historiqueTrajets;
    }

    public function setHistoriqueTrajets(array $historiqueTrajets): static
    {
        $this->historiqueTrajets = $historiqueTrajets;

        return $this;
    }

    /**
     * @return Collection<int, Voiture>
     */
    public function getVoitures(): Collection
    {
        return $this->voitures;
    }

    public function addVoiture(Voiture $voiture): static
    {
        if (!$this->voitures->contains($voiture)) {
            $this->voitures->add($voiture);
            $voiture->setConducteurr($this);
        }

        return $this;
    }

    public function removeVoiture(Voiture $voiture): static
    {
        if ($this->voitures->removeElement($voiture)) {
            // set the owning side to null (unless already changed)
            if ($voiture->getConducteurr() === $this) {
                $voiture->setConducteurr(null);
            }
        }

        return $this;
    }
}
