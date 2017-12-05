<?php

namespace gestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * chambre
 *
 * @ORM\Table(name="chambre")
 * @ORM\Entity(repositoryClass="gestionBundle\Repository\chambreRepository")
 */
class chambre
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
     *
     * @ORM\ManyToOne(targetEntity="service", inversedBy="chambre")
     * 
     */
    private $service;

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
     * Set service
     *
     * @param \gestionBundle\Entity\service $service
     * @return chambre
     */
    public function setService(\gestionBundle\Entity\service $service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \gestionBundle\Entity\service 
     */
    public function getService()
    {
        return $this->service;
    }
}
