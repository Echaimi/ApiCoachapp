<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AccountRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: AccountRepository::class)]
#[UniqueEntity('provider', 'providerAccountId')]
#[ApiResource]
class Account
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\CustomIdGenerator("doctrine.uuid_generator")]
    private ?Uuid $id = null;

    #[ORM\Column(length: 100)]
    private ?string $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $provider = null;

    #[ORM\Column(length: 255)]
    private ?string $providerAccountId = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $refresh_token = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $access_token = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $expires_at = null;

    #[ORM\Column(length: 255)]
    private ?string $token_type = null;

    #[ORM\Column(length: 255)]
    private ?string $scope = null;

    #[ORM\Column(length: 255)]
    private ?string $id_token = null;

    #[ORM\Column(length: 255)]
    private ?string $session_state = null;

    #[ORM\ManyToOne(inversedBy: 'accounts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userId = null;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getProvider(): ?string
    {
        return $this->provider;
    }

    public function setProvider(?string $provider): static
    {
        $this->provider = $provider;

        return $this;
    }

    public function getProviderAccountId(): ?string
    {
        return $this->providerAccountId;
    }

    public function setProviderAccountId(string $providerAccountId): static
    {
        $this->providerAccountId = $providerAccountId;

        return $this;
    }

    public function getRefreshToken(): ?string
    {
        return $this->refresh_token;
    }

    public function setRefreshToken(?string $refresh_token): static
    {
        $this->refresh_token = $refresh_token;

        return $this;
    }

    public function getAccessToken(): ?string
    {
        return $this->access_token;
    }

    public function setAccessToken(?string $access_token): static
    {
        $this->access_token = $access_token;

        return $this;
    }

    public function getExpiresAt(): ?\DateTimeImmutable
    {
        return $this->expires_at;
    }

    public function setExpiresAt(\DateTimeImmutable $expires_at): static
    {
        $this->expires_at = $expires_at;

        return $this;
    }

    public function getTokenType(): ?string
    {
        return $this->token_type;
    }

    public function setTokenType(string $token_type): static
    {
        $this->token_type = $token_type;

        return $this;
    }

    public function getScope(): ?string
    {
        return $this->scope;
    }

    public function setScope(string $scope): static
    {
        $this->scope = $scope;

        return $this;
    }

    public function getIdToken(): ?string
    {
        return $this->id_token;
    }

    public function setIdToken(string $id_token): static
    {
        $this->id_token = $id_token;

        return $this;
    }

    public function getSessionState(): ?string
    {
        return $this->session_state;
    }

    public function setSessionState(string $session_state): static
    {
        $this->session_state = $session_state;

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

}
