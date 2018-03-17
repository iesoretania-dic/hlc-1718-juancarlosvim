<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\ListaMusicaType;
use AppBundle\Entity\ListaMusica;
use AppBundle\Security\ListaMusicaVoter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ListaMusicaController extends Controller
{
    /**
     * @Route("/listas", name="ver_listas")
     * @Security("is_granted('ROLE_USER')")
     */
    public function mostrarListasAction()
    {
        $listas = $this->getDoctrine()->getRepository(ListaMusica::class)->findAll();

        return $this->render('listaMusica/listar.html.twig', ['listas' => $listas]);
    }
    /**
     * @Route("/lista/nueva", name="lista_nueva")
     * @Security("is_granted('ROLE_USER')")
     *
     */
    public function nuevaAction(Request $request, ListaMusica $lista =null)
    {
        $em = $this->getDoctrine()->getManager();

        if (null === $lista) {
            $lista = new ListaMusica();
            $lista->setPropietario($this->getUser());
            /*
             *  A la hora de crear una lista nueva, los usuarios VIP por defecto tendrá la lista de musica privada
             *  y los usuarios registrados pública
             */
            if($this->isGranted('ROLE_VIP')){
                $lista->setVisible(false);
            }else{
                $lista->setVisible(true);
            }
            $em->persist($lista);
        }

        $form = $this->createForm(ListaMusicaType::class, $lista, [
                'disabled' => !$this->isGranted(ListaMusicaVoter::MODIFICAR, $lista),
            'admin' => $this->isGranted('ROLE_ADMIN'),
            'vip' => $this->isGranted('ROLE_VIP')
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em->flush();
                return $this->redirectToRoute('ver_listas');
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
     * @Route("/lista/modificar/{id}", name="lista_Mostrar")
     * @Security("is_granted('LISTA_MODIFICAR', lista)")
     */
    public function mostrarListaAction(Request $request,ListaMusica $lista)
    {
        //dump($cancion);exit;
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ListaMusicaType::class, $lista,[
            'disabled' => !$this->isGranted(ListaMusicaVoter::MODIFICAR, $lista),
            'admin' => $this->isGranted('ROLE_ADMIN'),
            'vip' => $this->isGranted('ROLE_VIP')
        ]);

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
     * @Security("is_granted('LISTA_ELIMINAR', lista)")
     */
    public function eliminarAction(Request $request, ListaMusica $lista)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->isMethod('POST')) {
            try {
                // ojo: es necesario eliminar antes los votos y los comentarios

               /*foreach($lista->getPropietario() as $l) {
                    $em->remove($l);
                };*/

                // ya podemos eliminar la entidad
                $em->remove($lista);
                $em->flush();
                return $this->redirectToRoute('lista_eliminar');
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
