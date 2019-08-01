<?php

namespace App\Form;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use App\Form\RutType;
use \Symfony\Component\Form\DataMapperInterface;
use App\Form\DataTransformer\RutToTextTransformer;
use App\Entity\Cliente;
use App\Entity\Embeddable\Rut;

class ClienteType extends AbstractType {

    private $rutToTextTransformer;

    function __construct(RutToTextTransformer $rutToTextTransformer) {
        $this->rutToTextTransformer = $rutToTextTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre')
                ->add('apellido')
                ->add('rut', RutType::class, [
                    'mapped' => true,
                    'label' => false
                ])
        ;        
        
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class'    => Cliente::class,
        ]);
    }

}
