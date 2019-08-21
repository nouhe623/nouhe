<?php

namespace App\Entity;
use Cocur\Slugify\Slugify;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HotelRepository")
 */
class Hotel
{


    const avis =[
        0 => '0',
        1 => '1',
        2 => '2',
        3 => '3',
        4 => '4'
               ];



    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomhotel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    
    
     /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="hotel")
     */
     private $reserver;
 
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $occupation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $service;

    /**
     * @ORM\Column(type="text")
     */
    private $pension;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    private $hebergement;

    /**
     * @ORM\Column(type="text")
     */
    private $restauration;

     

    /**
     * @ORM\Column(type="text")
     */
    private $diveservice;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $avis;

  
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $destination;

  

/**
     * Permet d'obtenir un tableau des jours qui ne sont pas disponibles pour cette annonce
     *
     * @return array Un tableau d'objets DateTime représentant les jours d'occupation
     */
   

    public function __construct()
    {
        $this->reserver = new ArrayCollection();
    }


    /**
     * Permet d'initialiser le slug !
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * 
     * @return void
     */
     public function initializeSlug() {
        if(empty($this->slug)) {
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->nomhotel);
        }
    }

    public function getNotAvailableDays() {
        $notAvailableDays = [];

        foreach($this->reserver as $reserver) {
            // Calculer les jours qui se trouvent entre la date d'arrivée et de départ
            $resultat = range(
                $reserver->getStartDate()->getTimestamp(), 
                $reserver->getEndDate()->getTimestamp(), 
                24 * 60 * 60
            );
            
            $days = array_map(function($dayTimestamp){
                return new \DateTime(date('Y-m-d', $dayTimestamp));
            }, $resultat);

            $notAvailableDays = array_merge($notAvailableDays, $days);
        }

        return $notAvailableDays;
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomhotel(): ?string
    {
        return $this->nomhotel;
    }

    public function setNomhotel(string $nomhotel): self
    {
        $this->nomhotel = $nomhotel;

        return $this;
    }
    
    public function getSlug(): string
    {
        return (new slugify())->slugify($this->nomhotel);
        
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

   
 
 

 

    public function getOccupation(): ?string
    {
        return $this->occupation;
    }

    public function setOccupation(string $occupation): self
    {
        $this->occupation = $occupation;

        return $this;
    }

    public function getService(): ?string
    {
        return $this->service;
    }

    public function setService(string $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function getPension(): ?string
    {
        return $this->pension;
    }

    public function setPension(string $pension): self
    {
        $this->pension = $pension;

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

    public function getHebergement(): ?string
    {
        return $this->hebergement;
    }

    public function setHebergement(string $hebergement): self
    {
        $this->hebergement = $hebergement;

        return $this;
    }

    public function getRestauration(): ?string
    {
        return $this->restauration;
    }

    public function setRestauration(string $restauration): self
    {
        $this->restauration = $restauration;

        return $this;
    }

    public function getDiveService(): ?string
    {
        return $this->diveservice;
    }

    public function setDiveService(string $diveservice): self
    {
        $this->diveservice = $diveservice;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getAvis(): ?int
    {
        return $this->avis;
    }

    public function setAvis(int $avis): self
    {
        $this->avis = $avis;

        return $this;
    }

    

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }
 

 
     
 

     /**
     * @return Collection|Reservation[]
     */
     public function getReserver(): Collection
     {
         return $this->reserver;
     }
 
     public function addReserver(Reserver $reserver): self
     {
         if (!$this->reserver->contains($reserver)) {
              $this->reserver[] = $reserver;
              $reserver->setAd($this);
         }
 
         return $this;
     }
 
     public function removeReserver(Reserver $reserver): self
     {
         if ($this->reserver->contains($reserver)) {
             $this->reserver->removeElement($reserver);
             // set the owning side to null (unless already changed)
             if ($reserver->getAd() === $this) {
                 $reserver->setAd(null);
             }
         }

         return $this;
     }
     public function getCreatedAt(): ?\DateTimeInterface
     {
         return $this->createdAt;
     }
 
     public function setCreatedAt(?\DateTimeInterface $createdAt): self
     {
         $this->createdAt = $createdAt;
 
         return $this;
     } 

}
