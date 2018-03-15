<?php
/**
 * Created by PhpStorm.
 * User: alumno
 * Date: 15/03/18
 * Time: 10:08
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Cancion;
use Doctrine\ORM\EntityRepository;

class UsuarioRepository extends EntityRepository
{

    public function findCancionUsuario(Cancion $cancion)
    {
        return $this->createQueryBuilder('i')
            ->join('i.usuarios', 'user')
            ->where('user.id = :cancion')
            ->setParameter('cancion', $cancion)
            ->getQuery()
            ->getResult();
    }
}