<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vehicule
 *
 * @ORM\Table(name="vehicule")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\VehiculeRepository")
 */
class Vehicule
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, unique=false)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="immatriculation", type="string", length=10, unique=true)
     */
    private $immatriculation;

    /**
     * @var string
     *
     * @ORM\Column(name="marque", type="string", length=50)
     */
    private $marque;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=50)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="caracteristiques", type="text")
     */
    private $caracteristiques;

    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="decimal", precision=5, scale=2)
     */
    private $prix;

    /**
     * @var bool
     *
     * @ORM\Column(name="estLoue", type="boolean")
     */
    private $estLoue = false;

    /**
     * @ORM\ManyToOne(targetEntity="Agence", inversedBy="vehicules")
     * @ORM\JoinColumn(name="agence", referencedColumnName="id")
     */
    private $agence ;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set immatriculation
     *
     * @param string $immatriculation
     *
     * @return Vehicule
     */
    public function setImmatriculation($immatriculation)
    {
        $this->immatriculation = $immatriculation;

        return $this;
    }

    /**
     * Get immatriculation
     *
     * @return string
     */
    public function getImmatriculation()
    {
        return $this->immatriculation;
    }

    /**
     * Set marque
     *
     * @param string $marque
     *
     * @return Vehicule
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return string
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Vehicule
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set caracteristiques
     *
     * @param string $caracteristiques
     *
     * @return Vehicule
     */
    public function setCaracteristiques($caracteristiques)
    {
        $this->caracteristiques = $caracteristiques;

        return $this;
    }

    /**
     * Get caracteristiques
     *
     * @return string
     */
    public function getCaracteristiques()
    {
        return $this->caracteristiques;
    }

    /**
     * Set prix
     *
     * @param string $prix
     *
     * @return Vehicule
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return string
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set estLoue
     *
     * @param boolean $estLoue
     *
     * @return Vehicule
     */
    public function setEstLoue($estLoue)
    {
        $this->estLoue = $estLoue;

        return $this;
    }

    /**
     * Get estLoue
     *
     * @return bool
     */
    public function getEstLoue()
    {
        return $this->estLoue;
    }

    /**
     * Set agence
     *
     * @param \ApiBundle\Entity\Agence $agence
     *
     * @return Vehicule
     */
    public function setAgence(\ApiBundle\Entity\Agence $agence = null)
    {
        $this->agence = $agence;

        return $this;
    }

    /**
     * Get agence
     *
     * @return \ApiBundle\Entity\Agence
     */
    public function getAgence()
    {
        return $this->agence;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Vehicule
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
}
