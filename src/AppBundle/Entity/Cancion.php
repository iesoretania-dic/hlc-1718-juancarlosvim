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
    public function getArtista()
    {
        return $this->artista;
    }
    /**
     * @param mixed $artista
     */
    public function setArtista($artista)
    {
        $this->artista = $artista;
    }
    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }
    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }
    /**
     * @return mixed
     */
    public function getDuracion()
    {
        return $this->duracion;
    }
    /**
     * @param mixed $duracion
     */
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;
    }
    /**
     * @return mixed
     */
    public function getFechaCancion()
    {
        return $this->fechaCancion;
    }
    /**
     * @param mixed $fechaCancion
     */
    public function setFechaCancion($fechaCancion)
    {
        $this->fechaCancion = $fechaCancion;
    }
    /**
     * @return mixed
     */
    public function getGenero()
    {
        return $this->genero;
    }
    /**
     * @param mixed $genero
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;
    }

}