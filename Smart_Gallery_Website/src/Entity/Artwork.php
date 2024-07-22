<?php

namespace App\Entity;

use App\Repository\ArtworkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ArtworkRepository::class)]
class Artwork
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)] 
    #[Assert\NotBlank]
    private ?string $Name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank]
    #[Assert\Type(\DateTime::class)]
    private ?\DateTimeInterface $CompletionDate = null;

    #[ORM\Column(type: Types::TEXT)] 
    #[Assert\NotBlank]
    private ?string $Description = null;

    #[ORM\Column]
    private ?int $TotalViews = 0;

    #[ORM\Column]
    private ?bool $Approved = false;

    #[ORM\ManyToOne(inversedBy: 'Artworks')]
    #[ORM\JoinColumn(nullable: false)] 
    private ?User $Artist = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $ArtworkURL = null;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'Artworks')]
    private Collection $Category;

    #[ORM\Column(length: 255, nullable: true)]
    // #[Assert\Image]
    private ?string $ArtworkFile = null;

    #[ORM\OneToMany(mappedBy: 'Artwork', targetEntity: Comment::class, cascade: ['remove'])]
    private Collection $Comments;

    #[ORM\OneToMany(mappedBy: 'Artwork', targetEntity: Like::class, cascade: ['remove'])]
    private Collection $Likes;

    public function __construct()
    {
        $this->Category = new ArrayCollection();
        $this->Comments = new ArrayCollection();
        $this->Likes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getCompletionDate(): ?\DateTimeInterface
    {
        return $this->CompletionDate;
    }

    public function setCompletionDate(\DateTimeInterface $CompletionDate): self
    {
        $this->CompletionDate = $CompletionDate;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getTotalViews(): ?int
    {
        return $this->TotalViews;
    }

    public function setTotalViews(int $TotalViews): self
    {
        $this->TotalViews = $TotalViews;

        return $this;
    }

    public function isApproved(): ?bool
    {
        return $this->Approved;
    }

    public function setApproved(bool $Approved): self
    {
        $this->Approved = $Approved;

        return $this;
    }

    public function getArtist(): ?User
    {
        return $this->Artist;
    }

    public function setArtist(?User $Artist): self
    {
        $this->Artist = $Artist;

        return $this;
    }

    public function getArtworkURL(): ?string
    {
        return $this->ArtworkURL;
    }

    public function setArtworkURL(?string $ArtworkURL): self
    {
        $this->ArtworkURL = $ArtworkURL;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategory(): Collection
    {
        return $this->Category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->Category->contains($category)) {
            $this->Category->add($category);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->Category->removeElement($category);

        return $this;
    }

    public function getArtworkFile(): ?string
    {
        return $this->ArtworkFile;
    }

    public function setArtworkFile(?string $ArtworkFile): self
    {
        $this->ArtworkFile = $ArtworkFile;

        return $this;
    }

    public function getArtworkFilePath(): ?string
    {
        if (!$this->ArtworkFile) {
            return null;
        } 
        return sprintf('/uploads/artworks/%s', $this->ArtworkFile);
    }

    public function __toString()
    {
        return $this->Name . " by " . $this->Artist;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->Comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->Comments->contains($comment)) {
            $this->Comments->add($comment);
            $comment->setArtwork($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->Comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getArtwork() === $this) {
                $comment->setArtwork(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Like>
     */
    public function getLikes(): Collection
    {
        return $this->Likes;
    }

    public function addLike(Like $like): self
    {
        if (!$this->Likes->contains($like)) {
            $this->Likes->add($like);
            $like->setArtwork($this);
        }

        return $this;
    }

    public function removeLike(Like $like): self
    {
        if ($this->Likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getArtwork() === $this) {
                $like->setArtwork(null);
            }
        }

        return $this;
    }
}
