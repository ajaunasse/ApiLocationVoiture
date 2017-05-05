<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Location
 *
 * @ORM\Table(name="location")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\LocationRepository")
 */
class Location
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebutLocation", type="datetime")
     */
    private $dateDebutLocation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFinLocation", type="datetime")
     */
    private $dateFinLocation;

    /**
     * @var string
     *
     * @ORM\Column(name="prixTotal", type="decimal", precision=10, scale=2)
     */
    private $prixTotal;



    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="locations")
     * @ORM\JoinColumn(name="client", referencedColumnName="id")
     */
    private $client ;

    /**
     * @ORM\ManyToOne(targetEntity="Vehicule")
     * @ORM\JoinColumn(name="vehicule", referencedColumnName="id")
     */
    private $vehicule ;

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
     * Set dateDebutLocation
     *
     * @param \DateTime $dateDebutLocation
     *
     * @return Location
     */
    public function setDateDebutLocation($dateDebutLocation)
    {
        $this->dateDebutLocation = $dateDebutLocation;

        return $this;
    }

    /**
     * Get dateDebutLocation
     *
     * @return \DateTime
     */
    public function getDateDebutLocation()
    {
        return $this->dateDebutLocation;
    }

    /**
     * Set dateFinLocation
     *
     * @param \DateTime $dateFinLocation
     *
     * @return Location
     */
    public function setDateFinLocation($dateFinLocation)
    {
        $this->dateFinLocation = $dateFinLocation;

        return $this;
    }

    /**
     * Get dateFinLocation
     *
     * @return \DateTime
     */
    public function getDateFinLocation()
    {
        return $this->dateFinLocation;
    }
    

    /**
     * Set client
     *
     * @param \ApiBundle\Entity\Client $client
     *
     * @return Location
     */
    public function setClient(\ApiBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \ApiBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set vehicule
     *
     * @param \ApiBundle\Entity\Vehicule $vehicule
     *
     * @return Location
     */
    public function setVehicule(\ApiBundle\Entity\Vehicule $vehicule = null)
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    /**
     * Get vehicule
     *
     * @return \ApiBundle\Entity\Vehicule
     */
    public function getVehicule()
    {
        return $this->vehicule;
    }

    /**
     * Set prixTotal
     *
     * @param string $prixTotal
     *
     * @return Location
     */
    public function setPrixTotal($prixTotal)
    {
        $this->prixTotal = $prixTotal;

        return $this;
    }

    /**
     * Get prixTotal
     *
     * @return string
     */
    public function getPrixTotal()
    {
        return $this->prixTotal;
    }
}
