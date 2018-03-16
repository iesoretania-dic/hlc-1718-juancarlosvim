<?php
/**
 * Created by PhpStorm.
 * User: juancarlosvim
 * Date: 15/03/18
 * Time: 23:29
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\ListaMusica;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ListaMusicaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('nombre', null, [
                'label' => 'Nombre de la lista'
            ])
            ->add('propietario', null, [
                'label' => 'Propietario de la lista',
                'disabled' => !$options['admin']
            ])
            ->add('visible', null,[
                'label' => 'Visible',
                'disabled' => !$options['admin']
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ListaMusica::class,
            'admin' => false
        ]);
    }
}