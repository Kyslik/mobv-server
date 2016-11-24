<?php

namespace App\Exceptions;

use Exception;

class InvalidJsonException extends \InvalidArgumentException {

    public function __construct($message = '', $code = 422, Exception $previous = null)
    {
        $message = 'Invalid JSON.';
        parent::__construct($message, $code, $previous);
    }
}