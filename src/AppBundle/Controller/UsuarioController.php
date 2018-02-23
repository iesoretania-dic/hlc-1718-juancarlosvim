<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Usuario;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class UsuarioController extends Controller
{
    /**
     * @Route("/usuario", name="usuario_listar")
     */
    public function listarAction()
    {
        $usuarios =$this->getDoctrine()->getRepository('AppBundle:Usuario')->findAll();

        return $this->render('usuario/listar.html.twig', ['usuarios' => $usuarios ]);
    }

    /**
     * @Route("/usuario/{id}", name="usuario_mostrar")
     */
    public function mostrarAction(Usuario $usuario)
    {
        return $this->render('',
            ['usuario' => $usuario]);
    }

}
