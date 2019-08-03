<?php

namespace App\Form;

use App\Entity\Proveedor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Form\SucursalType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProveedorType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('razonSocial')
                ->add('alias')
                ->add('sucursales', CollectionType::class, [
                    'entry_type'    => SucursalType::class,
                    'allow_delete'  => true,
                    'delete_empty'  => true,
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Proveedor::class,
        ]);
    }

}
