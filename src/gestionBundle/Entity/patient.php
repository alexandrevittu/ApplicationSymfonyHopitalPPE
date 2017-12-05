<?php

namespace gestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * patient
 *
 * @ORM\Table(name="patient")
 * @ORM\Entity(repositoryClass="gestionBundle\Repository\patientRepository")
 */
class patient
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
     * @ORM\Column(name="numerosecu", type="string", length=255)
     */
    private $numerosecu;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datenaiss", type="date")
     */
    private $datenaiss;

    /**
     * @var int
     *
     * @ORM\Column(name="codepostal", type="integer")
     */
    private $codepostal;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255)
     */
    private $mail;

    /**
     * @var bool
     *
     * @ORM\Column(name="assurer", type="boolean")
     */
    private $assurer;

    /**
     *
     *
     * @ORM\OneToMany(targetEntity="sejours", mappedBy="patient")
     */
    private $sejours;


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
     * Set numerosecu
     *
     * @param string $numerosecu
     * @return patient
     */
    public function setNumerosecu($numerosecu)
    {
        $this->numerosecu = $numerosecu;

        return $this;
    }

    /**
     * Get numerosecu
     *
     * @return string
     */
    public function getNumerosecu()
    {
        return $this->numerosecu;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return patient
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
     * Set prenom
     *
     * @param string $prenom
     * @return patient
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set datenaiss
     *
     * @param \DateTime $datenaiss
     * @return patient
     */
    public function setDatenaiss($datenaiss)
    {
        $this->datenaiss = $datenaiss;

        return $this;
    }

    /**
     * Get datenaiss
     *
     * @return \DateTime
     */
    public function getDatenaiss()
    {
        return $this->datenaiss;
    }

    /**
     * Set codepostal
     *
     * @param integer $codepostal
     * @return patient
     */
    public function setCodepostal($codepostal)
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    /**
     * Get codepostal
     *
     * @return integer
     */
    public function getCodepostal()
    {
        return $this->codepostal;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return patient
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set assurer
     *
     * @param boolean $assurer
     * @return patient
     */
    public function setAssurer($assurer)
    {
        $this->assurer = $assurer;

        return $this;
    }

    /**
     * Get assurer
     *
     * @return boolean
     */
    public function getAssurer()
    {
        return $this->assurer;
    }

    /**
     * Set sejours
     *
     * @param \gestionBundle\Entity\sejours $sejours
     * @return patient
     */
    public function setSejours(\gestionBundle\Entity\sejours $sejours = null)
    {
        $this->sejours = $sejours;

        return $this;
    }

    /**
     * Get sejours
     *
     * @return \gestionBundle\Entity\sejours 
     */
    public function getSejours()
    {
        return $this->sejours;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sejours = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add sejours
     *
     * @param \gestionBundle\Entity\sejours $sejours
     * @return patient
     */
    public function addSejour(\gestionBundle\Entity\sejours $sejours)
    {
        $this->sejours[] = $sejours;

        return $this;
    }

    /**
     * Remove sejours
     *
     * @param \gestionBundle\Entity\sejours $sejours
     */
    public function removeSejour(\gestionBundle\Entity\sejours $sejours)
    {
        $this->sejours->removeElement($sejours);
    }
}
