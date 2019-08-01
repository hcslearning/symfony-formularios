<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use App\Entity\Embeddable\Rut;

class RutValidoValidator extends ConstraintValidator {

    public function validate($value, Constraint $constraint) {
        /* @var $constraint \App\Validator\RutValido */

        if (null === $value || '' === $value) {
            return;
        }

        if (!$value instanceof Rut) {
            throw new UnexpectedValueException($value, 'Rut');
        }


        // TODO: implement the validation here
        if (!$value->isValid()) {
            $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ value }}', $value)
                    ->addViolation();
        }
    }

}
