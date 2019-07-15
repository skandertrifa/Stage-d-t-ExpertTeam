<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Session
 *
 * @ORM\Table(name="session")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\SessionRepository")
 */
class Session
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
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\Theme")
     */
    protected $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", columnDefinition="enum('planifié', 'retardé', 'en cours','annulé','terminé')")
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\Formateur",inversedBy="sessions")
     */
    protected $formateur;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date")
     */
    private $dateFin;
    
    /**
     * @ORM\ManyToMany(targetEntity="AdminBundle\Entity\User")
     */
    protected $user;

    
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
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Session
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Session
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add user
     *
     * @param \AdminBundle\Entity\User $user
     *
     * @return Session
     */
    public function addUser(\AdminBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AdminBundle\Entity\User $user
     */
    public function removeUser(\AdminBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set nom
     *
     * @param \AdminBundle\Entity\Theme $nom
     *
     * @return Session
     */
    public function setNom(\AdminBundle\Entity\Theme $nom = null)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return \AdminBundle\Entity\Theme
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Session
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set formateur
     *
     * @param \AdminBundle\Entity\Formateur $formateur
     *
     * @return Session
     */
    public function setFormateur(\AdminBundle\Entity\Formateur $formateur = null)
    {
        $this->formateur = $formateur;

        return $this;
    }

    /**
     * Get formateur
     *
     * @return \AdminBundle\Entity\Formateur
     */
    public function getFormateur()
    {
        return $this->formateur;
    }
}
