<?php
/**
 * Created by PhpStorm.
 * User: juancarlosvim
 * Date: 15/03/18
 * Time: 18:43
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\Cancion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CancionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('artista', null, [
                'label' => 'Artista'
            ])
            ->add('titulo', null, [
                'label' => 'Título'
            ])
            ->add('duracion', null, [
                'label' => 'Duración de la canción'
            ])
            ->add('fechaCancion', null,[
                'label' => 'Fecha de la canción',
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('genero', null,[
                'label' => 'Género de la canción'
            ])
            ->add('usuarios', null,[
                'label' => 'Usuarios que han escuchado la canción',
                'expanded' => true,
                'multiple' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cancion::class,

        ]);
    }

}