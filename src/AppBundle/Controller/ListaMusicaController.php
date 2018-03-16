<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\ListaMusicaType;
use AppBundle\Entity\ListaMusica;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
class ListaMusicaController extends Controller
{
    /**
     * @Route("/listas", name="ver_listas")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function mostrarListasAction()
    {
        $listas = $this->getDoctrine()->getRepository(ListaMusica::class)->findAll();

        return $this->render('listaMusica/listar.html.twig', ['listas' => $listas]);
    }
    /**
     * @Route("/lista/nueva", name="lista_nueva")
     *
     * @Security("is_granted('ROLE_USER')")
     */
    public function nuevaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $lista = new ListaMusica();
        $em->persist($lista);

        $form = $this->createForm(ListaMusicaType::class, $lista, [
            'admin' => $this->isGranted('ROLE_ADMIN')
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em->flush();
                return $this->redirectToRoute('lista_Mostrar');
            }
            catch (\Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }

        return $this->render('listaMusica/form.html.twig', [
            'lista' => $lista,
            'formulario' => $form->createView()
        ]);
    }

    /**
     * @Route("/lista/{id}", name="lista_Mostrar")
     * @Security("is_granted('ROLE_USER')")
     */
    public function mostrarListaAction(Request $request,ListaMusica $lista)
    {
        //dump($cancion);exit;
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ListaMusicaType::class, $lista);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em->flush();
                return $this->redirectToRoute('ver_listas');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }

        }

        $usuario = $lista->getPropietario();
        return $this->render('listaMusica/form.html.twig', [
            'lista' => $lista,
            'usuario' => $usuario,
            'formulario' => $form->createView()

        ]);

    }

    /**
     * @Route("/lista/eliminar/{id}", name="lista_eliminar")
     * @Security("is_granted('ROLE_ADMIN')")
     *
     */
    public function eliminarAction(Request $request, ListaMusica $lista)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->isMethod('POST')) {
            try {
                // ojo: es necesario eliminar antes los votos y los comentarios
                foreach($lista->getId() as $l) {
                    $em->remove($l);
                };

                // ya podemos eliminar la entidad
                $em->remove($lista);
                $em->flush();
                return $this->redirectToRoute('lista_Mostrar');
            }
            catch (\Exception $e) {
                $this->addFlash('error', 'No se ha podido eliminar la lista');
            }
        }

        return $this->render('listaMusica/eliminar.html.twig', [
            'lista' => $lista
        ]);
    }


}
