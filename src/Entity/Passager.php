<?php

namespace App\Entity;

use App\Repository\PassagerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PassagerRepository::class)]
class Passager extends User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    private ?float $noteMoyenne = null;

    #[ORM\Column(type: Types::ARRAY,nullable: true)]
    private array $historiqueReservations = [];

    /**
     * @var Collection<int, Feedback>
     */
    #[ORM\OneToMany(targetEntity: Feedback::class, mappedBy: 'passager')]
    private Collection $feedback;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'passager')]
    private Collection $reservations;

    public function __construct()
    {
        $this->feedback = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getHistoriqueReservations(): array
    {
        return $this->historiqueReservations;
    }

    public function setHistoriqueReservations(array $historiqueReservations): static
    {
        $this->historiqueReservations = $historiqueReservations;

        return $this;
    }

    /**
     * @return Collection<int, Feedback>
     */
    public function getFeedback(): Collection
    {
        return $this->feedback;
    }

    public function addFeedback(Feedback $feedback): static
    {
        if (!$this->feedback->contains($feedback)) {
            $this->feedback->add($feedback);
            $feedback->setPassager($this);
        }

        return $this;
    }

    public function removeFeedback(Feedback $feedback): static
    {
        if ($this->feedback->removeElement($feedback)) {
            // set the owning side to null (unless already changed)
            if ($feedback->getPassager() === $this) {
                $feedback->setPassager(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setPassager($this);  // Corrigé la relation ici
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getPassager() === $this) {
                $reservation->setPassager(null);  // Corrigé la relation ici
            }
        }

        return $this;
    }
}
