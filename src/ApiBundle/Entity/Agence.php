<?php

namespace ApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Agence
 *
 * @ORM\Table(name="agence")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\AgenceRepository")
 */
class Agence
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="codepostal", type="string", length=10)
     */
    private $codepostal;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=50)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="CA", type="decimal", precision=12, scale=2)
     */
    private $cA;

    /**
     * @ORM\OneToMany(targetEntity="Vehicule", mappedBy="agence")
     */
    private $vehicules;

    public function __construct()
    {
        $vehicules = new ArrayCollection() ;
    }

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
     * Set nom
     *
     * @param string $nom
     *
     * @return Agence
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Agence
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set codepostal
     *
     * @param string $codepostal
     *
     * @return Agence
     */
    public function setCodepostal($codepostal)
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    /**
     * Get codepostal
     *
     * @return string
     */
    public function getCodepostal()
    {
        return $this->codepostal;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Agence
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set cA
     *
     * @param string $cA
     *
     * @return Agence
     */
    public function setCA($cA)
    {
        $this->cA = $cA;

        return $this;
    }

    /**
     * Get cA
     *
     * @return string
     */
    public function getCA()
    {
        return $this->cA;
    }

    /**
     * Add vehicule
     *
     * @param \ApiBundle\Entity\Vehicule $vehicule
     *
     * @return Agence
     */
    public function addVehicule(\ApiBundle\Entity\Vehicule $vehicule)
    {
        $this->vehicules[] = $vehicule;

        return $this;
    }

    /**
     * Remove vehicule
     *
     * @param \ApiBundle\Entity\Vehicule $vehicule
     */
    public function removeVehicule(\ApiBundle\Entity\Vehicule $vehicule)
    {
        $this->vehicules->removeElement($vehicule);
    }

    /**
     * Get vehicules
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVehicules()
    {
        return $this->vehicules;
    }
}
