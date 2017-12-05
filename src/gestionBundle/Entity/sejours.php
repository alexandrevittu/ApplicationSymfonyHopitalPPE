<?php

namespace gestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * sejours
 *
 * @ORM\Table(name="sejours")
 * @ORM\Entity(repositoryClass="gestionBundle\Repository\sejoursRepository")
 */
class sejours
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
     * @ORM\Column(name="datedebut", type="date")
     */
    private $datedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datefin", type="date")
     */
    private $datefin;
	
	 /**
     * @var int
     *
     * @ORM\Column(name="numlit", type="integer")
     */
    private $numlit;

    /**
     *
     *
     * @ORM\ManyToOne(targetEntity="patient", inversedBy="sejours")
     */
    private $patient;
	
	/**
     *
     *
     * @ORM\ManyToOne(targetEntity="chambre", inversedBy="sejours")
     */
    private $leschambres;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set datedebut
     *
     * @param \DateTime $datedebut
     * @return sejours
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    /**
     * Get datedebut
     *
     * @return \DateTime
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * Set datefin
     *
     * @param \DateTime $datefin
     * @return sejours
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;

        return $this;
    }

    /**
     * Get datefin
     *
     * @return \DateTime
     */
    public function getDatefin()
    {
        return $this->datefin;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->patient = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set numlit
     *
     * @param integer $numlit
     * @return sejours
     */
    public function setNumlit($numlit)
    {
        $this->numlit = $numlit;

        return $this;
    }

    /**
     * Get numlit
     *
     * @return integer 
     */
    public function getNumlit()
    {
        return $this->numlit;
    }

    /**
     * Add patient
     *
     * @param \gestionBundle\Entity\patient $patient
     * @return sejours
     */
    public function addPatient(\gestionBundle\Entity\patient $patient)
    {
        $this->patient[] = $patient;

        return $this;
    }

    /**
     * Remove patient
     *
     * @param \gestionBundle\Entity\patient $patient
     */
    public function removePatient(\gestionBundle\Entity\patient $patient)
    {
        $this->patient->removeElement($patient);
    }

    /**
     * Get patient
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPatient()
    {
        return $this->patient;
    }

    /**
     * Set leschambres
     *
     * @param \gestionBundle\Entity\chambre $leschambres
     * @return sejours
     */
    public function setLeschambres(\gestionBundle\Entity\chambre $leschambres = null)
    {
        $this->leschambres = $leschambres;

        return $this;
    }

    /**
     * Get leschambres
     *
     * @return \gestionBundle\Entity\chambre 
     */
    public function getLeschambres()
    {
        return $this->leschambres;
    }

    /**
     * Set patient
     *
     * @param \gestionBundle\Entity\patient $patient
     * @return sejours
     */
    public function setPatient(\gestionBundle\Entity\patient $patient = null)
    {
        $this->patient = $patient;

        return $this;
    }
}
