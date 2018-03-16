<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Usuario;
use AppBundle\Form\Type\UsuarioType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


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

    /**
     * @Route("/usuario/editar/{id}", name="editar_usuario")
     */
    public function editarUsuarioAction(Request $request,Usuario $usuario)
    {
        //dump($cancion);exit;
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(UsuarioType::class, $usuario);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em->flush();
                return $this->redirectToRoute('usuario_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }

        }


        return $this->render('usuario/form.html.twig', [
            'usuario' => $usuario,
            'formulario' => $form->createView()

        ]);
    }

}
