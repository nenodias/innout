<?php

class ValidationException extends Exception
{

    private $errors = [];

    public function __construct($errors = [], $message = "Erro de validação", $code = 0, $previous = null)
    {
        $this->errors = $errors;
        parent::__construct($message, $code, $previous);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function get($att)
    {
        return $this->errors[$att];
    }
}
