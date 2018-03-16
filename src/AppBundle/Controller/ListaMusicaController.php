<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\ListaMusicaType;
use AppBundle\Entity\ListaMusica;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/lista/{id}", name="lista_Mostrar")
     */
    public function mostrarListaAction(Request $request,ListaMusica $lista)
    {
        //dump($cancion);exit;
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ListaMusicaType::class, $lista);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try{
                $em->flush();
                return $this->redirectToRoute('ver_listas');
            }
            catch (\Exception $e){
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

}
