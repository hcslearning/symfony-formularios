<?php

namespace App\Form;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use \Symfony\Component\Form\DataMapperInterface;
use App\Form\DataTransformer\RutToTextTransformer;
use App\Entity\Cliente;
use App\Entity\Embeddable\Rut;

class RutType extends AbstractType implements DataMapperInterface {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('rut', TextType::class, [
                    'help' => 'Ej. 13999222-k'
                ])
        ;        
        $builder->setDataMapper($this);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Rut::class,
        ]);
    }

    public function mapDataToForms($viewData, $forms) {
        // there is no data yet, so nothing to prepopulate
        if (null === $viewData) {
            return;
        }

        // invalid data type
        if (!$viewData instanceof Rut) {
            throw new UnexpectedTypeException($viewData, Rut::class);
        }

        /** @var FormInterface[] $forms */
        $forms = iterator_to_array($forms);

        $forms['rut']->setData(
                $viewData->getRut() . '-' . $viewData->getDv()
        );
    }

    public function mapFormsToData($forms, &$viewData) {
        /** @var FormInterface[] $forms */
        $forms = iterator_to_array($forms);

        // as data is passed by reference, overriding it will change it in
        // the form object as well
        // beware of type inconsistency, see caution below
        $rut = Rut::parse($forms['rut']->getData());
        
        $viewData->setRut($rut->getRut());
        $viewData->setDv($rut->getDv());
    }

}
