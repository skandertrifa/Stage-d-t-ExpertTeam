<?php
// src/AdminBundle/Entity/User.php

namespace AdminBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\UserRepository")
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{


    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;



    /**
     * @ORM\OneToMany(targetEntity="AdminBundle\Entity\Paiement",mappedBy="user", fetch="EXTRA_LAZY")
     */
    protected $paiement;



    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50)
     * @Assert\NotBlank(message="Préciser le type s'il vous plaît", groups={"Registration", "Profile"})
     */
    private $type;




    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="S'il vous plaît entrez votre numero de telephone.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=7,
     *     max=25,
     *     minMessage="Le numero de telephone est trop court.",
     *     maxMessage="Le numero de telephone est trop long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $numeroTelephone;




    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="S'il vous plaît entrez votre nom.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="Le nom est trop court.",
     *     maxMessage="Le nom est trop long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $nom;




    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="S'il vous plaît entrez votre prenom.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="Le prenom est trop court.",
     *     maxMessage="Le prenom est trop long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $prenom;





    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="S'il vous plaît entrez votre profession.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="Le message du champ est trop court.",
     *     maxMessage="Le message du champ est trop long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $profession;




    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="S'il vous plaît entrez comment avez vous entendu parlé de nous.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=5,
     *     max=255,
     *     minMessage="Le message est trop court.",
     *     maxMessage="Le message est trop long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $canalDeCommunication;

    /**
     * @ORM\Column(nullable=true)
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\ClientPro",inversedBy="users")
     */
    protected $clientPro;




    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }



    /**
     * Set type
     *
     * @param string $type
     *
     * @return User
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set numeroTelephone
     *
     * @param string $numeroTelephone
     *
     * @return User
     */
    public function setNumeroTelephone($numeroTelephone)
    {
        $this->numeroTelephone = $numeroTelephone;

        return $this;
    }

    /**
     * Get numeroTelephone
     *
     * @return string
     */
    public function getNumeroTelephone()
    {
        return $this->numeroTelephone;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
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
     *
     * @return User
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
     * Set profession
     *
     * @param string $profession
     *
     * @return User
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;

        return $this;
    }

    /**
     * Get profession
     *
     * @return string
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * Set canalDeCommunication
     *
     * @param string $canalDeCommunication
     *
     * @return User
     */
    public function setCanalDeCommunication($canalDeCommunication)
    {
        $this->canalDeCommunication = $canalDeCommunication;

        return $this;
    }

    /**
     * Get canalDeCommunication
     *
     * @return string
     */
    public function getCanalDeCommunication()
    {
        return $this->canalDeCommunication;
    }

    /**
     * Set clientPro
     *
     * @param \AdminBundle\Entity\ClientPro $clientPro
     *
     * @return User
     */
    public function setClientPro(\AdminBundle\Entity\ClientPro $clientPro = null)
    {
        $this->clientPro = $clientPro;

        return $this;
    }

    /**
     * Get clientPro
     *
     * @return \AdminBundle\Entity\ClientPro
     */
    public function getClientPro()
    {
        return $this->clientPro;
    }



    /**
     * Add paiement
     *
     * @param \AdminBundle\Entity\Paiement $paiement
     *
     * @return User
     */
    public function addPaiement(\AdminBundle\Entity\Paiement $paiement)
    {
        $this->paiement[] = $paiement;

        return $this;
    }

    /**
     * Remove paiement
     *
     * @param \AdminBundle\Entity\Paiement $paiement
     */
    public function removePaiement(\AdminBundle\Entity\Paiement $paiement)
    {
        $this->paiement->removeElement($paiement);
    }

    /**
     * Get paiement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPaiement()
    {
        return $this->paiement;
    }
}
