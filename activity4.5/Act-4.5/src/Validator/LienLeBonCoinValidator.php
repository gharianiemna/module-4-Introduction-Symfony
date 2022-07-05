<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class LienLeBonCoinValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var App\Validator\LienLeBonCoin $constraint */

        if (null === $value || '' === $value) {
            return;
        }

        // TODO: implement the validation here
        if ('https://www.leboncoin.fr/categorie/identifiant.htm/' != $value) { 
            $this->context->buildViolation($constraint->message)
            ->addViolation();
    }
    }
}
