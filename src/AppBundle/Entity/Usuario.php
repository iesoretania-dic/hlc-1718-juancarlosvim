<?php
/**
 * Created by PhpStorm.
 * User: alumno
 * Date: 2/02/18
 * Time: 10:30
 */

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Nelmio\Alice\Instances\Collection;


/**
 * @ORM\Entity
 * @ORM\Table(name="usuario")
 */
class Usuario
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     *
     *@var int
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $nombreUsuario;
    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $password;
    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $nombre;
    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $apellidos;
    /**
     * @ORM\Column(type="date", nullable=true)
     *
     * @var \DateTime
     */
    private $fechaNacimiento;
    /**
     * @ORM\Column(type="string")
     *
     *@var string
     */
    private $correo;
    /**
     * @ORM\Column(type="boolean")
     *
     *@var boolean
     */
    private $administrador;
    /**
     * @ORM\Column(type="boolean")
     *
     * @var boolean
     */
    private $usuarioVip;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ListaMusica", mappedBy="propietario")
     *
     * @var Collection|ListaMusica[]
     */
    private $listasPublicadas;

    public  function __construct()
    {
        $this->listasPublicadas = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getNombreUsuario();
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }
    /**
     * @param mixed $nombreUsuario
     */
    public function setNombreUsuario($nombreUsuario)
    {
        $this->nombreUsuario = $nombreUsuario;
    }
    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }
    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    /**
     * @return mixed
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }
    /**
     * @param mixed $apellidos
     */
    public function setApellidos($apellidos)
    {
    $this->apellidos = $apellidos;
    }/**
     * @return mixed
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }/**
     * @param mixed $fechaNacimiento
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }/**
     * @return mixed
     */
    public function getCorreo()
    {
        return $this->correo;
    }/**
     * @param mixed $correo
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }/**
     * @return mixed
     */
    public function getAdministrador()
    {
        return $this->administrador;
    }/**
     * @param mixed $administrador
     */
    public function setAdministrador($administrador)
    {
        $this->administrador = $administrador;
    }/**
     * @return mixed
     */
    public function getUsuarioVip()
    {
        return $this->usuarioVip;
    }/**
     * @param mixed $usuarioVip
     */
    public function setUsuarioVip($usuarioVip)
    {
        $this->usuarioVip = $usuarioVip;
    }




    }