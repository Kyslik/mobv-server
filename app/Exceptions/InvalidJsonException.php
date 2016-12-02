<?php

namespace App\Exceptions;

use Exception;

class InvalidJsonException extends \InvalidArgumentException
{

    public function __construct($message = '', $code = 422, Exception $previous = null)
    {
        $message = 'Invalid Json or sent data are empty "[]"';
        parent::__construct($message, $code, $previous);
    }
}
