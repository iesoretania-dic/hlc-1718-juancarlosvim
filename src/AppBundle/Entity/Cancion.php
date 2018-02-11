<?php
/**
 * Created by PhpStorm.
 * User: alumno
 * Date: 2/02/18
 * Time: 10:47
 */

namespace AppBundle\Entity;


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


}