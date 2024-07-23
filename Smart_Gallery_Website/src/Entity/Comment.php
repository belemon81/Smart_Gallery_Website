<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $User = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    private ?string $Content = null;

    #[ORM\ManyToOne(inversedBy: 'Comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Artwork $Artwork = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $CommentTime = null;

    // public function __construct()
    // {
    //     $this->Replies = new ArrayCollection();
    // }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->Content;
    }

    public function setContent(string $Content): self
    {
        $this->Content = $Content;

        return $this;
    }

    public function getArtwork(): ?Artwork
    {
        return $this->Artwork;
    }

    public function setArtwork(?Artwork $Artwork): self
    {
        $this->Artwork = $Artwork;

        return $this;
    }

    public function getCommentTime(): ?\DateTimeInterface
    {
        return $this->CommentTime;
    }

    public function setCommentTime(\DateTimeInterface $CommentTime): self
    {
        $this->CommentTime = $CommentTime;

        return $this;
    }
}
