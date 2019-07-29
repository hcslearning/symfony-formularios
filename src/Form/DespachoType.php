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
        // se configura valor por defecto a 0 en configureOptions()
        // 0 = muestra todos los campos
        // 1 = paso uno, muestra información personal
        // 2 = muestra campos para despacho
        $paso = intval($options['paso']);
        $tipos = ['CASA', 'DEPTO', 'OFICINA'];
        $tipos = array_combine($tipos, $tipos);

        $builder
                ->add('nombreCompleto')
                ->add('rut', null, [
                    'required' => true,
                    'help' => 'Sin puntos ni dígito verificador (Ej. 76809666)',
                ])
                ->add('dv', TextType::class, [
                    'label' => 'Dígito Verificador',
                    'mapped' => false,
                ])
                ->add('tipo', ChoiceType::class, [
                    'mapped' => false,
                    'choices' => $tipos,
                ])
                ->add('direccion', null, [
                    'help' => '(Ej. Av. Vespucio Norte 322)'
                ])
                ->add('comuna')
                ->add('telefono')
                ->add('email')
        ;

        switch ($paso) {
            case 0:
                // mantiene todos los campos
                break;
            case 1:
                // información de contacto
                $fs = ['comuna', 'direccion', 'tipo'];
                foreach ($fs as $f) {
                    $builder->remove($f);
                }
                break;
            case 2:
                // información de despacho
                $fs = ['comuna', 'direccion', 'tipo'];
                foreach ($builder->all() as $k => $v) {
                    if( !in_array($k, $fs) ) {
                        $builder->remove($k);
                    }                    
                }
                break;
            default :
        }
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Despacho::class,
            'paso' => 0
        ]);
    }

}
