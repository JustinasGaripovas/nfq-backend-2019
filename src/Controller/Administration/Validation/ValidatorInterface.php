<?php

namespace App\Controller\Administration\Validation;

interface ValidatorInterface
{
    public function validate(array $data): ValidationResult;
}