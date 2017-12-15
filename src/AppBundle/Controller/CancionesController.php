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
          1=>  ['id'=> 1, 'artista' => 'The Unguided', 'titulo' => 'Phoenix Down', 'duracion' => '3:33', 'anio' => '2011', 'descripcion' => 'The Unguided son un grupo de metal sueco creado por Richard Sjunnesson tras su partida de Sonic Syndicate. Más tarde se unirían el cantante (y antiguo integrante de Sonic Syndicate) Roland Johansson, el guitarrista Roger Sjunnesson, por aquella época miembro de Sonic Syndicate, John Bengtsson como batería y al bajo Henric Carlson, actualmente también componente de Cipher System.'],
           7=> ['id'=> 7, 'artista' => 'Five Finger Death Punch', 'titulo' => 'Bad Company', 'duracion' => '4:22', 'anio' => '2009', 'descripcion'=> 'Five Finger Death Punch (abreviado como 5FDP o FFDP) es una banda estadounidense de Groove Metal de Las Vegas, Nevada. Formado en 2005, el nombre del grupo está derivado de cine de artes marciales orientales clásico. La banda originalmente estuvo formada por el cantante Ivan Moody, el guitarrista Zoltan Bathory, el guitarrista Caleb Bingham, el bajista Matt Snell y el percusionista Jeremy Spencer. Bingham fue reemplazado por Darrell Roberts en 2006, y este lo fue por Jason Hook en 2009. Matt Snell salió de la banda en 2010, siendo sustituido por Chris Kael en 2011.'],
            8=> ['id' => 8, 'artista' => 'Five Finger Death Punch', 'titulo' => 'Wrong Side of Heaven', 'duracion' => '4:31', 'anio' => '2013', 'descripcion' => 'Five Finger Death Punch (abreviado como 5FDP o FFDP) es una banda estadounidense de Groove Metal de Las Vegas, Nevada. Formado en 2005, el nombre del grupo está derivado de cine de artes marciales orientales clásico. La banda originalmente estuvo formada por el cantante Ivan Moody, el guitarrista Zoltan Bathory, el guitarrista Caleb Bingham, el bajista Matt Snell y el percusionista Jeremy Spencer. Bingham fue reemplazado por Darrell Roberts en 2006, y este lo fue por Jason Hook en 2009. Matt Snell salió de la banda en 2010, siendo sustituido por Chris Kael en 2011.']


        ];

    }
}
