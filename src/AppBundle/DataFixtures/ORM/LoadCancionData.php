<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Cancion;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCancionData implements ORMFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // creamos una nueva idea simplemente creando una instancia de la entidad y diciéndole al
        // EntityManager que la supervise
        $cancion = new Cancion();
        $manager->persist($cancion);

        // rellenamos sus datos usando los setters (al ser fluent, se pueden poner en cascada)
        $cancion
            ->setTitulo('titulo1')
            ->setArtista('');


        // decimos al EntityManager que queremos guardar todos los cambios hechos en las entidades
        $manager->flush();
    }
}
