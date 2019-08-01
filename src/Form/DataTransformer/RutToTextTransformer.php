<?php

namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use App\Entity\Embeddable\Rut;

class RutToTextTransformer implements DataTransformerInterface {
    
    /**
     * string to object
     * @param string $str
     */
    public function reverseTransform($str) {
        if(!$str) {
            return;
        }
        
        $rut = Rut::parse($str);
        if(!$rut->isValid()) {
            throw new TransformationFailedException(
                    sprintf('El RUT %s no es válido', $str)
                    );
        }
        
        return $rut;
    }

    /**
     * Rut a string
     * @param Rut $object
     */
    public function transform($object) {
        if(null === $object) {
            return '';
        }
        
        return $object->getRut().'-'.$object->getDv();
    }

}
