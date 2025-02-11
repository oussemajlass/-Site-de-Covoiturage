<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]  // Nom de la table, attention aux backticks pour le SGBD
#[ORM\InheritanceType("JOINED")]  // Héritage de type "JOINED" pour les sous-classes
#[ORM\DiscriminatorColumn(type: "string", name: "type")]
#[ORM\DiscriminatorMap(["passager_db" => "Passager", "conducteur_db" => "Conducteur"])]
abstract class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    protected ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $telephone = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateInscription = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $avis = [];

    /**
     * Relation ManyToMany avec Notification
     * @var Collection<int, Notification>
     */
    #[ORM\ManyToMany(targetEntity: Notification::class)]
    private Collection $notifications;

    public function __construct()
    {
        $this->notifications = new ArrayCollection();
    }

    // Getter et Setter pour chaque propriété
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeInterface $dateInscription): static
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    public function getAvis(): array
    {
        return $this->avis;
    }

    public function setAvis(array $avis): static
    {
        $this->avis = $avis;

        return $this;
    }

    /**
     * Récupère les notifications
     *
     * @return Collection<int, Notification>
     */
    public function getNotifications(): Collection
    {
        return $this->notifications;
    }

    public function addNotification(Notification $notification): static
    {
        if (!$this->notifications->contains($notification)) {
            $this->notifications->add($notification);
        }

        return $this;
    }

    public function removeNotification(Notification $notification): static
    {
        $this->notifications->removeElement($notification);

        return $this;
    }
}
