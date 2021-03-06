<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class LienLeBonCoin extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */    public $message = 'The value "{{ value }}" is not valid.';

    public function validatedBy()
    {
    
         return static::class.'Validator';
    }
}
