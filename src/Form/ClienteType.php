<?php

namespace App\Form;

use App\Entity\Cliente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Form\DataTransformer\RutToTextTransformer;

class ClienteType extends AbstractType {

    private $rutToTextTransformer;

    function __construct(RutToTextTransformer $rutToTextTransformer) {
        $this->rutToTextTransformer = $rutToTextTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre')
                ->add('apellido')
                ->add('rut', TextType::class, [
                    'mapped' => false,
                    'help'  => 'Ej. 13999222-k'
                ])
        ;

        $builder
                ->get('rut')
                ->addModelTransformer($this->rutToTextTransformer)
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Cliente::class,
        ]);
    }

}
