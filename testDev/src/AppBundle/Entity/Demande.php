<?php

namespace AppBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

class Demande
{
    /**
	* @var string
	*
	* @Assert\NotBlank()
	*/
    private $nom;
	
	/**
	* @var string
	*
	* @Assert\NotBlank()
	*/
    private $prenom;
	
	/**
	* @var string
	*
	* @Assert\NotBlank()
	*/
	private $email;
	
	/**
	* @var string
	*
	* @Assert\NotBlank()
	*/
	private $telephone;
	
	/**
	* @var string
	*
	* @Assert\NotBlank()
	*/
	private $message;

	//Getters
    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

	public function getEmail()
    {
        return $this->email;
    }
	
	public function getTelephone()
    {
        return $this->telephone;
    }
	
	public function getMessage()
    {
        return $this->message;
    }
	
	//Setters
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

	public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }
	
	public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
	
	public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
        return $this;
    }
	
	public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

}
