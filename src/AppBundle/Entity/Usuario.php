<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsuarioRepository")
 */
class Usuario
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
     * @ORM\Column(name="nombre", type="string", length=70)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=70, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="tipousuario", type="string", length=70)
     */
    private $tipousuario;

    /**
     * @var string
     *
     * @ORM\Column(name="contrasena", type="string", length=255)
     */
    private $contrasena;


//    /**
//     * @ORM\OneToMany(targetEntity="Tickets",mappedBy="usuario")
//     */
//    private $tickets;
//
//    public function __construct()
//    {
//        $this->tickets = new ArrayCollection();
//    }






    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Usuario
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     * @return Usuario
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return Usuario
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getTipousuario()
    {
        return $this->tipousuario;
    }

    /**
     * @param string $tipousuario
     * @return Usuario
     */
    public function setTipousuario($tipousuario)
    {
        $this->tipousuario = $tipousuario;
        return $this;
    }

    /**
     * @return string
     */
    public function getContrasena()
    {
        return $this->contrasena;
    }

    /**
     * @param string $contrasena
     * @return Usuario
     */
    public function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;
        return $this;
    }








}

