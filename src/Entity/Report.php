<?php

namespace App\Entity;

use App\Repository\ReportRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReportRepository::class)]
class Report
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?int $numberOfClients = null;

    #[ORM\Column]
    private ?int $numberOfInvoices = null;

    #[ORM\Column]
    private ?int $numberOfQuotes = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 1, scale: 2)]
    private ?string $totalEarned = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $revenue = null;

    public function getId(): ?int
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

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

    public function getNumberOfClients(): ?int
    {
        return $this->numberOfClients;
    }

    public function setNumberOfClients(int $numberOfClients): static
    {
        $this->numberOfClients = $numberOfClients;

        return $this;
    }

    public function getNumberOfInvoices(): ?int
    {
        return $this->numberOfInvoices;
    }

    public function setNumberOfInvoices(int $numberOfInvoices): static
    {
        $this->numberOfInvoices = $numberOfInvoices;

        return $this;
    }

    public function getNumberOfQuotes(): ?int
    {
        return $this->numberOfQuotes;
    }

    public function setNumberOfQuotes(int $numberOfQuotes): static
    {
        $this->numberOfQuotes = $numberOfQuotes;

        return $this;
    }

    public function getTotalEarned(): ?string
    {
        return $this->totalEarned;
    }

    public function setTotalEarned(string $totalEarned): static
    {
        $this->totalEarned = $totalEarned;

        return $this;
    }

    public function getRevenue(): ?string
    {
        return $this->revenue;
    }

    public function setRevenue(string $revenue): static
    {
        $this->revenue = $revenue;

        return $this;
    }
}
