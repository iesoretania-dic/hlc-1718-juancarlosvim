<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CancionController extends Controller
{
    /**
     * @Route("/canciones", name="canciones_listar")
     */
    public function listarAction()
    {
        $canciones =$this->getDoctrine()->getRepository('AppBundle:Cancion')->findAll();

        return $this->render('canciones/listar.html.twig', ['canciones' => $canciones ]);
    }

    /**
     * @Route("/canciones/{id}", name="canciones_mostrar")
     */
    public function mostrarAction($id)
    {
        $cancion = $canciones = $this->getDoctrine()->getRepository('AppBundle:Cancion')->find($id);
        if(null == $cancion){
            throw $this->createNotFoundException();
        }

        return $this->render('canciones/mostrarCancion.html.twig',
            ['canciones' => $cancion]);
    }


}
