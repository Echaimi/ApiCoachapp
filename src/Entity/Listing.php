<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ListingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ListingRepository::class)]
#[ApiResource]
class   Listing
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\CustomIdGenerator("doctrine.uuid_generator")]
    private ?Uuid $id = null;

    #[ORM\Column(length: 50)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageSrc = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\Column]
    private ?int $roomCount = null;

    #[ORM\Column]
    private ?int $bathroomCount = null;

    #[ORM\Column]
    private ?int $guestCount = null;

    #[ORM\Column(length: 255)]
    private ?string $locationValue = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\ManyToOne(inversedBy: 'listings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userId = null;

    #[ORM\OneToMany(mappedBy: 'listingId', targetEntity: Reservation::class, orphanRemoval: true)]
    private Collection $reservations;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImageSrc(): ?string
    {
        return $this->imageSrc;
    }

    public function setImageSrc(?string $imageSrc): static
    {
        $this->imageSrc = $imageSrc;

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

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getRoomCount(): ?int
    {
        return $this->roomCount;
    }

    public function setRoomCount(int $roomCount): static
    {
        $this->roomCount = $roomCount;

        return $this;
    }

    public function getBathroomCount(): ?int
    {
        return $this->bathroomCount;
    }

    public function setBathroomCount(int $bathroomCount): static
    {
        $this->bathroomCount = $bathroomCount;

        return $this;
    }

    public function getGuestCount(): ?int
    {
        return $this->guestCount;
    }

    public function setGuestCount(int $guestCount): static
    {
        $this->guestCount = $guestCount;

        return $this;
    }

    public function getLocationValue(): ?string
    {
        return $this->locationValue;
    }

    public function setLocationValue(string $locationValue): static
    {
        $this->locationValue = $locationValue;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): static
    {
        $this->userId = $userId;

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
            $reservation->setListingId($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getListingId() === $this) {
                $reservation->setListingId(null);
            }
        }

        return $this;
    }
}
