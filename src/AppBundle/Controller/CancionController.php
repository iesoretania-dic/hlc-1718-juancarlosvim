<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\CancionType;
use AppBundle\Entity\Cancion;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

class CancionController extends Controller
{
    /**
     * @Route("/canciones", name="cancion_listar")
     */
    public function listarAction()
    {
        $canciones = $this->getDoctrine()->getRepository('AppBundle:Cancion')->findAll();

        return $this->render('cancion/listar.html.twig', ['canciones' => $canciones]);
    }
    /**
     * @Route("/cancion/nueva", name="cancion_nueva")
     * @Security("is_granted('ROLE_ADMIN')")
     *
     *
     */
    public function nuevaCancionAction(Request $request, Cancion $cancion =null)
    {
        $em = $this->getDoctrine()->getManager();

        if (null === $cancion) {
            $cancion = new Cancion();
            $cancion->setArtista('');
            $cancion->setTitulo('');
            $cancion->setDuracion('');
            $cancion->setFechaCancion(new \DateTime());
            $cancion->setGenero('');


            $em->persist($cancion);
        }

        $form = $this->createForm(CancionType::class, $cancion);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em->flush();
                return $this->redirectToRoute('cancion_listar');
            }
            catch (\Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }

        return $this->render('cancion/form.html.twig', [
            'cancion' => $cancion,
            'formulario' => $form->createView()
        ]);
    }

    /**
     * @Route("/cancion/usuario/{id}", name="cancion_usuario_mostrar")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function mostrarUsuarioAction(Cancion $cancion)
    {
        //dump($cancion);exit;

        $usuarios = $cancion->getUsuarios();
        return $this->render('cancion/mostrarCancionUsuario.html.twig', [
            'cancion' => $cancion,
            'usuarios' => $usuarios
        ]);
    }

    /**
     * @Route("/cancion/{id}", name="cancion_mostrar")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function mostrarAction(Request $request,Cancion $cancion)
    {
        //dump($cancion);exit;
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(CancionType::class, $cancion);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try{
                $em->flush();
                return $this->redirectToRoute('cancion_listar');
            }
            catch (\Exception $e){
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }

        }

        $usuarios = $cancion->getUsuarios();
        return $this->render('cancion/form.html.twig', [
            'cancion' => $cancion,
            'usuarios' => $usuarios,
            'formulario' => $form->createView()

        ]);
    }



    /**
     * @Route("/cancion/eliminar/{id}", name="cancion_eliminar")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function eliminarCancionAction(Request $request, Cancion $cancion)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->isMethod('POST')) {
            try {
                // ojo: es necesario eliminar antes los votos y los comentarios

                /*foreach($lista->getPropietario() as $l) {
                     $em->remove($l);
                 };*/

                // ya podemos eliminar la entidad
                $em->remove($cancion);
                $em->flush();
                return $this->redirectToRoute('cancion_listar');
            }
            catch (\Exception $e) {
                $this->addFlash('error', 'No se ha podido eliminar la cancion');
            }
        }

        return $this->render('cancion/eliminar.html.twig', [
            'cancion' => $cancion
        ]);
    }

}
