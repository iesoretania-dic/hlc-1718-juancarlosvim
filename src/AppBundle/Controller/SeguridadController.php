<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SeguridadController extends Controller
{
    /**
     * @Route("/entrar", name="usuario_entrar")
     */
    public function entrarAction(AuthenticationUtils $authUtils)
    {
        // obtener el error de autenticación (si hay alguno)
        $error = $authUtils->getLastAuthenticationError();

        // obtener el último nombre de usuario enviado
        $ultimoUsuario = $authUtils->getLastUsername();

        return $this->render('seguridad/entrar.html.twig', [
            'ultimo_usuario' => $ultimoUsuario,
            'error' => $error,
        ]);
    }

    /**
     * @Route("/salir", name="usuario_salir")
     */
    public function salirAction()
    {
        // no contiene nada porque Symfony interceptará la petición y la acción
        // nunca se ejecutará
    }
}
