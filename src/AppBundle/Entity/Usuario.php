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
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @ORM\Entity
 * @ORM\Table(name="usuario")
 */
class Usuario implements UserInterface
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
     *
     *
     *
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $password;
    /**
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     *
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
     *
     * @ORM\Column(type="date", nullable=true)
     *
     * @var \DateTime
     */
    private $fechaNacimiento;
    /**
     *
     * @Assert\Email(
     *     message = "El correo electrónico '{{ value }}' no es válido.",
     *     checkMX = true
     * )
     *
     * @ORM\Column(type="string")
     *
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
    /**
     * @param ListaMusica $lista
     * @return Usuario
     */
    public function addListaPublicada(ListaMusica $lista)
    {
        if (!$this->listasPublicadas->contains($lista)) {
            $this->listasPublicadas->add($lista);
        }

        return $this;
    }

    /**
     * @param ListaMusica $lista
     * @return Usuario
     */
    public function removeListaPublicada(ListaMusica $lista)
    {
        $this->listasPublicadas->removeElement($lista);

        return $this;
    }
    /**
     * @param ListaMusica[]|Collection $listasPublicadas
     */
    public function setListasPublicadas($listasPublicadas)
    {
        $this->listasPublicadas = $listasPublicadas;
    }
    /**
     * @return ListaMusica[]|Collection
     */
    public function getListasPublicadas()
    {
        return $this->listasPublicadas;
    }



    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        // inicialmente todos los usuarios tienen el rol ROLE_USER
        $roles = ['ROLE_USER'];

        // si es administrador, añadir el rol ROLE_ADMIN
        if ($this->getAdministrador()) {
            $roles[] = 'ROLE_ADMIN';
        }

        // si es moderador, añadir el rol ROLE_MODERADOR
        if ($this->getUsuarioVip()) {
            $roles[] = 'ROLE_VIP';
        }


        return $roles;
    }

    /** getPassword() estaba ya definido, así que no hace falta tocarlo */

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // no usamos sal para codificar las contraseñas
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->getNombreUsuario();
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // no hacer nada
    }


}