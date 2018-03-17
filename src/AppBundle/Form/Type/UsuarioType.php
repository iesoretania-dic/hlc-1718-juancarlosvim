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
                'label' => 'Nombre de usuario',
                'disabled' => !$options['admin']
            ])
            ->add('password', null, [
                'label' => 'Contraseña',
                'disabled' => !$options['admin']
            ])
            ->add('nombre', null,[
                'label' => 'Nombre Real',
                'disabled' => !$options['admin']
            ])
            ->add('apellidos', null,[
                'label' => 'Apellidos',
                'disabled' => !$options['admin']
            ])
            ->add('fechaNacimiento', null,[
                'label' => 'Fecha Nacimiento',
                'widget' => 'single_text',
                'disabled' => !$options['admin']
            ])
            ->add('correo', null,[
                'label' => 'Correo Electrónico',
                'disabled' => !$options['admin']

            ])
            ->add('administrador', null,[
                'label' => 'Adminsitrador',
                'disabled' => !$options['admin']

            ])
            ->add('usuarioVip', null,[
                'label' => 'Usuario Vip',
                'disabled' => !$options['admin']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
            'admin'=> false
        ]);
    }

}