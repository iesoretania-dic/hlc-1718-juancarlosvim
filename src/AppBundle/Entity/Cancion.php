<?php
/**
 * Created by PhpStorm.
 * User: alumno
 * Date: 2/02/18
 * Time: 10:47
 */

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="cancion")
 */
class Cancion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $artista;
    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $titulo;
    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $duracion;
    /**
     * @ORM\Column(type="date")
     *
     *@var \DateTime
     */
    private $fechaCancion;
    /**
     * @ORM\Column(type="string")
     *
     *@var string
     */
    private $genero;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Usuario")
     *
     * @var Collection|Usuario[]
     */
    private $usuarios;



    public  function __construct()
    {
        $this->usuarios = new ArrayCollection();
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $artista
     */
    public function setArtista($artista)
    {
        $this->artista = $artista;
    }

    /**
     * @param string $titulo
     * @return Cancion
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
        return $this;
    }

    /**
     * @param string $duracion
     * @return Cancion
     */
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;
        return $this;
    }

    /**
     * @param \DateTime $fechaCancion
     * @return Cancion
     */
    public function setFechaCancion($fechaCancion)
    {
        $this->fechaCancion = $fechaCancion;
        return $this;
    }

    /**
     * @param string $genero
     * @return Cancion
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getArtista()
    {
        return $this->artista;
    }

    /**
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @return string
     */
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * @return \DateTime
     */
    public function getFechaCancion()
    {
        return $this->fechaCancion;
    }

    /**
     * @return string
     */
    public function getGenero()
    {
        return $this->genero;
    }
    /**
     * @param Usuario $usuario
     * @return Cancion
     */
    public function addUsuario(Usuario $usuario)
    {
        if (!$this->usuarios->contains($usuario)) {
            $this->usuarios->add($usuario);
        }

        return $this;
    }

    /**
     * @param Usuario $usuario
     * @return Cancion
     */
    public function removeUsuario(Usuario $usuario)
    {
        $this->usuarios->removeElement($usuario);

        return $this;
    }

    /**
     * @return Collection|Usuario[]
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * @param Collection|Usuario[] $usuarios
     * @return Cancion
     */
    public function setUsuarios($usuarios)
    {
        $this->usuarios = $usuarios;
        return $this;
    }
}