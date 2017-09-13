<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Login
 *
 * @ORM\Table(name="login")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LoginRepository")
 */
class Login
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
     * @ORM\Column(name="identifiant", type="string", length=50, unique=true)
	 * @Assert\NotBlank()
	 * @Assert\Length(max=50)
     */
    private $identifiant;

    /**
     * @var string
     *
     * @ORM\Column(name="mdp", type="string", length=255)
	 * @Assert\NotBlank()
	 * @Assert\Length(max=255)
     */
    private $mdp;

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
     * Get identifiant
     *
     * @return string
     */
    public function getIdentifiant()
    {
        return $this->identifiant;
    }

    /**
     * Get mdp
     *
     * @return string
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Set identifiant
     *
     * @param string $identifiant
     *
     * @return Login
     */
    public function setIdentifiant($identifiant)
    {
        $this->identifiant = $identifiant;

        return $this;
    }

    /**
     * Set mdp
     *
     * @param string $mdp
     *
     * @return Login
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;

        return $this;
    }
}
