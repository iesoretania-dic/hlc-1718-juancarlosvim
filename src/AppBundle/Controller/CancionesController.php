<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CancionesController extends Controller
{
    /**
     * @Route("/canciones", name="canciones_listar")
     */
    public function listarAction()
    {
        $canciones =$this->getCanciones();





        return $this->render('canciones/listar.html.twig', ['canciones' => $canciones ]);
    }

    private function getCanciones(){

        return [
            ['artista' => 'The Unguided', 'titulo' => 'Phoenix Down', 'duracion' => '3:33', 'anio' => '2011' ],
            ['artista' => 'Five Finger Death Punch', 'titulo' => 'Bad Company', 'duracion' => '4:22', 'anio' => '2009'],
            ['artista' => 'Five Finger Death Punch', 'titulo' => 'Wrong Side of Heaven', 'duracion' => '4:31', 'anio' => '2013']


        ];

    }
}
