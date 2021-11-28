<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=VoitureRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class Voiture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     * @Assert\NotBlank(message="Veuillez renseigner un modèle")
     */
    private $modele;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Veuillez intoduire le nombre de kilomètres")
     * @Assert\Length(max="7", maxMessage="Votre véhicule est trop vieux pour être vendu !")
     * @Assert\PositiveOrZero(message="Vous ne pouvez pas avoir {{ value }} pour le nombre de km, le nombre de km doit être au minimum de {{ compared_value }}")
     */
    private $km;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="Veuillez introduire le prix")
     */
    private $prix;
    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank(message="Veuillez introduire le nombre de propriétaires")
     * @Assert\PositiveOrZero(message="Vous ne pouvez pas introduire {{ value }} pour le nombre de propriétaires, le nombre de propriétaires doit être au minimum de {{ compared_value }} ")
     */
    private $nombres_proprietaires;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Veuillez introduire la cylindrée")
     */
    private $cylindree;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Veuillez introduire la Puissance")
     */
    private $puissance;

    /**
     * @ORM\Column(type="date", nullable=true)
     *
     */
    private $mise_circulation;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Veuillez introduire le type de Carburant (GPL, Diesel, Essence, Electrique, Hybride)")
     *
     */
    private $carburant;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Veuillez introduire le type de Transmission (Manuelle ou Automatique)")
     */
    private $transmission;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez introduire une description du véhicule")
     * @Assert\Length(min="20", max="255", minMessage="La description doit être de plus de 20 caractères", maxMessage="La description doit être de moins de 255 caractères")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Veuillez introduire les options du véhicule")
     */
    private $options;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez introduire l'URL de l'image de couverture")
     * @Assert\Url(message="Cet URL n'est pas valide, veuillez introduire une URL valide")
     */
    private $coverImage;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="voiture")
     */
    private $images;

    /**
     * @ORM\ManyToOne(targetEntity=Marque::class, inversedBy="voiture")
     * @ORM\JoinColumn(nullable=false)
     */
    private $marque;

    /**
     * Initialisation du slug automatique
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function initializeSlug()
    {
        if (empty($this->slug)) {
            $slugify = new Slugify();
            $marque = new Marque();
            $this->slug = $slugify->slugify($marque->getName().' '.$this->getModele().' '.rand());
        }
    }

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getKm(): ?int
    {
        return $this->km;
    }

    public function setKm(int $km): self
    {
        $this->km = $km;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getNombresProprietaires(): ?int
    {
        return $this->nombres_proprietaires;
    }

    public function setNombresProprietaires(?int $nombres_proprietaires): self
    {
        $this->nombres_proprietaires = $nombres_proprietaires;

        return $this;
    }

    public function getCylindree(): ?string
    {
        return $this->cylindree;
    }

    public function setCylindree(string $cylindree): self
    {
        $this->cylindree = $cylindree;

        return $this;
    }

    public function getPuissance(): ?string
    {
        return $this->puissance;
    }

    public function setPuissance(string $puissance): self
    {
        $this->puissance = $puissance;

        return $this;
    }

    public function getMiseCirculation(): ?\DateTimeInterface
    {
        return $this->mise_circulation;
    }

    public function setMiseCirculation(?\DateTimeInterface $mise_circulation): self
    {
        $this->mise_circulation = $mise_circulation;

        return $this;
    }

    public function getCarburant(): ?string
    {
        return $this->carburant;
    }

    public function setCarburant(string $carburant): self
    {
        $this->carburant = $carburant;

        return $this;
    }

    public function getTransmission(): ?string
    {
        return $this->transmission;
    }

    public function setTransmission(string $transmission): self
    {
        $this->transmission = $transmission;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getOptions(): ?string
    {
        return $this->options;
    }

    public function setOptions(string $options): self
    {
        $this->options = $options;

        return $this;
    }

    public function getCoverImage(): ?string
    {
        return $this->coverImage;
    }

    public function setCoverImage(string $coverImage): self
    {
        $this->coverImage = $coverImage;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setVoiture($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getVoiture() === $this) {
                $image->setVoiture(null);
            }
        }

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

}
