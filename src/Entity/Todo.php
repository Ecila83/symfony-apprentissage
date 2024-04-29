<?php

namespace App\Entity;

use App\Repository\TodoRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
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

  #[ORM\Column(type: "integer")]
  private $priority;

  #[ORM\Column(type: "datetime", options: ['default' => 'CURRENT_TIMESTAMP'])]
  private $createdAt;

  #[ORM\ManyToOne(inversedBy: 'todos')]
  private ?Author $author = null;

  #[ORM\ManyToMany(targetEntity: Tag::class, mappedBy: 'todos')]
  private Collection $tags;

  public function __construct()
  {
      $this->tags = new ArrayCollection();
  }

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

  public function isDone(): ?bool
  {
      return $this->done;
  }

  public function getPriority(): ?int
  {
      return $this->priority;
  }

  public function setPriority(int $priority): static
  {
      $this->priority = $priority;

      return $this;
  }

  public function getAuthor(): ?Author
  {
      return $this->author;
  }

  public function setAuthor(?Author $author): static
  {
      $this->author = $author;

      return $this;
  }

  /**
   * @return Collection<int, Tag>
   */
  public function getTags(): Collection
  {
      return $this->tags;
  }

  public function addTag(Tag $tag): static
  {
      if (!$this->tags->contains($tag)) {
          $this->tags->add($tag);
          $tag->addTodo($this);
      }

      return $this;
  }

  public function removeTag(Tag $tag): static
  {
      if ($this->tags->removeElement($tag)) {
          $tag->removeTodo($this);
      }

      return $this;
  }
}
