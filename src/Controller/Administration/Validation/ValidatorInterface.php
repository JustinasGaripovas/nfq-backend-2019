<?php

namespace App\Controller\Administration;

interface ValidatorInterface
{
    public function validate(array $data): ValidationResult;
}