<?php

namespace App\Controller\Administration;

class ValidationResult
{
    /** @var bool */
    private $isValid;

    /** @var string|null */
    private $validationMessage;

    /**
     * @param bool $isValid
     * @param string|null $validationMessage
     */
    public function __construct(bool $isValid, string $validationMessage = null)
    {
        $this->isValid = $isValid;
        $this->validationMessage = $validationMessage;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->isValid;
    }

    /**
     * @return string|null
     */
    public function getValidationMessage(): ?string
    {
        return $this->validationMessage;
    }
}