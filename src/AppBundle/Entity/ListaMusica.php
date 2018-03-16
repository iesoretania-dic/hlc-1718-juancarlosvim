<?php
/**
 * Created by PhpStorm.
 * User: alumno
 * Date: 15/03/18
 * Time: 10:48
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Nelmio\Alice\Instances\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="lista_musica")
 */
class ListaMusica
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private  $id;
    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $nombre;
    /**
     * @ORM\Column(type="boolean")
     *
     * @var boolean
     */
    private $visible;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Usuario", inversedBy="listasPublicadas")
     * @ORM\JoinColumn(nullable=false)
     * @var Usuario
     */
    private  $propietario;

    public function __toString()
    {
        return $this->getNombre();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return bool
     */
    public function isVisible()
    {
        return $this->visible;
    }

    /**
     * @param bool $visible
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;
    }

    /**
     * @return Usuario
     */
    public function getPropietario()
    {
        return $this->propietario;
    }

    /**
     * @param Usuario $propietario
     */
    public function setPropietario($propietario)
    {
        $this->propietario = $propietario;
    }

}