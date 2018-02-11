<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Cancion;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;

use Doctrine\Common\Persistence\ObjectManager;

class LoadCancionData implements ORMFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // creamos una nueva idea simplemente creando una instancia de la entidad y diciéndole al
        // EntityManager que la supervise
        $cancion = new Cancion();
        $cancion2 = new Cancion();

        $manager->persist($cancion);
        $manager->persist($cancion2);

        // rellenamos sus datos usando los setters (al ser fluent, se pueden poner en cascada)
        $cancion
            ->setGenero('rock')
            ->setDuracion('3min')
            ->setFechaCancion(new \DateTime())
            ->setTitulo('titulo')
            ->setArtista('artista');
        $cancion2
            ->setGenero('rock')
            ->setDuracion('3min')
            ->setFechaCancion(new \DateTime())
            ->setTitulo('titulo2')
            ->setArtista('artista');



        // decimos al EntityManager que queremos guardar todos los cambios hechos en las entidades
        $manager->flush();
    }
}
