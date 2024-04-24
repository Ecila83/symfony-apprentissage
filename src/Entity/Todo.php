<?php

namespace App\Entity;

use App\Repository\TodoRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TodoRepository::class)]
class Todo
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column(type: "integer")]
  private $id;

  #[ORM\Column(type: "string", length: 255)]
  private $content;

  #[ORM\Column(type: "boolean", options: ['default' => false])]
  private $done = false;

  #[ORM\Column(type: "datetime", options: ['default' => 'CURRENT_TIMESTAMP'])]
  private $createdAt;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getContent(): ?string
  {
    return $this->content;
  }

  public function setContent(string $content): self
  {
    $this->content = $content;

    return $this;
  }

  public function getDone(): ?bool
  {
    return $this->done;
  }

  public function setDone(bool $done): self
  {
    $this->done = $done;

    return $this;
  }

  public function getCreatedAt(): ?DateTime
  {
    return $this->createdAt;
  }

  public function setCreatedAt( $createdAt): self
  {
    $this->createdAt = $createdAt;

    return $this;
  }
}
