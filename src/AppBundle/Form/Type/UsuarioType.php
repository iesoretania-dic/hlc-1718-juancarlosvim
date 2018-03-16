<?php
/**
 * Created by PhpStorm.
 * User: juancarlosvim
 * Date: 16/03/18
 * Time: 9:14
 */


namespace AppBundle\Form\Type;

use AppBundle\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreUsuario', null, [
                'label' => 'Nombre de usuario'
            ])
            ->add('password', null, [
                'label' => 'Contraseña'
            ])
            ->add('nombre', null,[
                'label' => 'Nombre Real'
            ])
            ->add('apellidos', null,[
                'label' => 'Apellidos'
            ])
            ->add('fechaNacimiento', null,[
                'label' => 'Fecha Nacimiento',
                'widget' => 'single_text'
            ])
            ->add('correo', null,[
                'label' => 'Correo Electrónico',

            ])
            ->add('administrador', null,[
                'label' => 'Adminsitrador',

            ])
            ->add('usuarioVip', null,[
                'label' => 'Usuario Vip',

            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }

}