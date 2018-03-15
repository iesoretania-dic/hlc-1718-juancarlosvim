<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ListaMusica;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListaMusicaController extends Controller
{
    /**
     * @Route("/listas", name="ver_listas")
     */
    public function mostrarListasAction()
    {
        $listas = $this->getDoctrine()->getRepository(ListaMusica::class)->findAll();

        return $this->render('listaMusica/listar.html.twig', ['listas' => $listas]);
    }

}
