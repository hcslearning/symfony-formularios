<?php

namespace App\Form;

use App\Entity\Despacho;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DespachoType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $tipos = ['CASA', 'DEPTO', 'OFICINA'];
        $tipos = array_combine($tipos, $tipos);
        $builder
                ->add('nombreCompleto')
                ->add('rut', null, [
                    'required'  => true,
                    'help'  => 'Sin puntos ni dígito verificador (Ej. 76809666)',
                ])
                ->add('dv', TextType::class, [
                    'label'     => 'Dígito Verificador',
                    'mapped'    => false,
                ])
                ->add('tipo', ChoiceType::class, [
                    'mapped' => false,
                    'choices' => $tipos,
                ])
                ->add('direccion', null, [
                    'help'  => '(Ej. Av. Vespucio Norte 322)'
                ])
                ->add('comuna')
                ->add('telefono')
                ->add('email')
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Despacho::class,
        ]);
    }

}
