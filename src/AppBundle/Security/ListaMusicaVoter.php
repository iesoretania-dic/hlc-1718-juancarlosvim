<?php
/**
 * Created by PhpStorm.
 * User: juancarlosvim
 * Date: 16/03/18
 * Time: 13:42
 */

namespace AppBundle\Security;


use AppBundle\Entity\ListaMusica;
use AppBundle\Entity\Usuario;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;

class ListaMusicaVoter extends Voter
{
    const VER = 'LISTA_VER';
    const MODIFICAR = 'LISTA_MODIFICAR';
    const ELIMINAR = 'LISTA_ELIMINAR';
    const CREAR = 'LISTA_CREAR';



    private $decisionManager;

    public function __construct(AccessDecisionManagerInterface $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }

    /**
     * {@inheritdoc}
     */
    protected function supports($attribute, $subject)
    {
        // indicar si el Voter soporta el atributo y el sujeto indicados

        // si el sujeto no es una cancion, devolver false
        if (!$subject instanceof ListaMusica) {
            return false;
        }

        // si no es uno de los atributos definidos arriba, devolver false
        if (!in_array($attribute, [self::VER, self::MODIFICAR, self::ELIMINAR, self::CREAR], true)) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        // si estamos aquí, es seguro que el sujeto es una idea y el atributo uno de los definidos arriba

        $user = $token->getUser();

        if (!$user instanceof Usuario) {
            // debería haber un usuario activo en la aplicación, denegar si no es así
            return false;
        }

        // si el usuario tiene ROLE_ADMIN, siempre tiene permiso
        if ($this->decisionManager->decide($token, ['ROLE_ADMIN'])) {
            return true;
        }

        switch ($attribute) {
            case self::VER:
                return $this->puedeVer($subject, $token, $user);
            case self::MODIFICAR:
                return $this->puedeModificar($subject, $token, $user);
            case self::ELIMINAR:
                return $this->puedeEliminar($subject, $token, $user);
            case self::CREAR:
                return $this->puedenCrear($subject, $token, $user);

        }

        // por defecto, denegar el permiso
        return false;
    }

    private function puedeVer(ListaMusica $listaMusica, TokenInterface $token, Usuario $user)
    {
        if ($listaMusica->getPropietario() === $user) {
            // es el usuario
            return true;
        }

        return $this->decisionManager->decide($token, ['ROLE_ADMIN']);

    }
    private function puedenCrear(ListaMusica $listaMusica, TokenInterface $token, Usuario $user)
    {
        // solo el propietario y un administrador pueden crear una idea

        if ($listaMusica->getPropietario() === $user) {
            // es el usuario
            return true;
        }

        return $this->decisionManager->decide($token, ['ROLE_ADMIN']);
    }

    private function puedeModificar(ListaMusica $listaMusica, TokenInterface $token, Usuario $user)
    {
        // solo el propietario y un administrador pueden modificar una idea

        if ($listaMusica->getPropietario() === $user) {
            // es el usuario
            return true;
        }

        return $this->decisionManager->decide($token, ['ROLE_ADMIN']);
    }

    private function puedeEliminar(ListaMusica $listaMusica, TokenInterface $token, Usuario $user)
    {
        // solo el propietario y un admin pueden eliminar una idea

        if ($listaMusica->getPropietario() === $user) {
            // es el usuario de la lista
            return true;
        }

        return $this->decisionManager->decide($token, ['ROLE_ADMIN']);
    }




}