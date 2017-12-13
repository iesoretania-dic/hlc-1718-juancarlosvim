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
        return $this->render('canciones/listar.html.twig');
    }
}
