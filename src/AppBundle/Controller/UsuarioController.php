<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Usuario;
use AppBundle\Form\Type\CambioClaveType;
use AppBundle\Form\Type\UsuarioType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UsuarioController extends Controller
{
    /**
     * @Route("/usuario", name="usuario_listar")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function listarAction()
    {
        $usuarios =$this->getDoctrine()->getRepository('AppBundle:Usuario')->findAll();

        return $this->render('usuario/listar.html.twig', ['usuarios' => $usuarios ]);
    }

    /**
     * @Route("/usuario/nuevo", name="usuario_nuevo")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function nuevaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $usuario = new Usuario();
        $em->persist($usuario);

        $form = $this->createForm(UsuarioType::class, $usuario, [
            'admin' => $this->isGranted('ROLE_ADMIN')
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em->flush();
                return $this->redirectToRoute('usuario_listar');
            }
            catch (\Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }

        return $this->render('usuario/form.html.twig', [
            'usuario' => $usuario,
            'formulario' => $form->createView()
        ]);
    }


    /**
     * @Route("/usuario/editar/{id}", name="editar_usuario")
     * @Security("is_granted('ROLE_ADMIN')")
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

    /**
     * @Route("/usuario/eliminar/{id}", name="usuario_eliminar")
     * @Security("is_granted('ROLE_ADMIN')")
     *
     */
    public function eliminarAction(Request $request, Usuario $usuario)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->isMethod('POST')) {
            try {
                // ojo: es necesario eliminar antes los votos y los comentarios
                foreach($usuario->getListasPublicadas() as $listaMusica) {
                    $em->remove($listaMusica);
                };

                // ya podemos eliminar la entidad
                $em->remove($usuario);
                $em->flush();
                return $this->redirectToRoute('usuario_listar');
            }
            catch (\Exception $e) {
                $this->addFlash('error', 'No se ha podido eliminar el usuario');
            }
        }

        return $this->render('usuario/eliminar.html.twig', [
            'usuario' => $usuario
        ]);
    }


    /**
     * @Route("/usuario/clave", name="usuario_cambiar_clave")
     * @Security("is_granted('ROLE_USER')")
     */
    public function cambiarClave(Request $request, UserPasswordEncoderInterface $userPasswordEncoder)
    {
        /** @var Usuario $usuario */
        $usuario = $this->getUser();

        $formulario = $this->createForm(CambioClaveType::class, $usuario);

        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {
            $textoPlano = $formulario->get('nuevaClave')->get('first')->getData();

            try {
                $usuario->setPassword(
                    $userPasswordEncoder->encodePassword($usuario, $textoPlano)
                );
                $this->getDoctrine()->getManager()->flush();
                $this->addFlash('info', 'Contraseña cambiada con éxito');

                return $this->redirectToRoute('inicio');
            }
            catch(\Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }

        return $this->render('usuario/cambio_clave.html.twig', [
            'formulario' => $formulario->createView()
        ]);
    }




}
