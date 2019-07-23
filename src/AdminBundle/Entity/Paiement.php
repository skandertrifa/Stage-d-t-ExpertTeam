<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paiement
 *
 * @ORM\Table(name="paiement")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\PaiementRepository")
 */
class Paiement
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
     * @ORM\Column(name="nom", type="string", length=50)
     */
    private $nom;




    /**
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\User",inversedBy="paiement")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;




    /**
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\Session",inversedBy="paiement")
     * @ORM\JoinColumn(nullable=false)
     */
    private $session;



    /**
     * Constructor
     */
    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getNom();
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
     * @return Paiement
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
     * Set user
     *
     * @param \AdminBundle\Entity\User $user
     *
     * @return Paiement
     */
    public function setUser(\AdminBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AdminBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set session
     *
     * @param \AdminBundle\Entity\Session $session
     *
     * @return Paiement
     */
    public function setSession(\AdminBundle\Entity\Session $session)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get session
     *
     * @return \AdminBundle\Entity\Session
     */
    public function getSession()
    {
        return $this->session;
    }
}
