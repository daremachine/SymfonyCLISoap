<?php
declare(strict_types=1);

namespace UkLocation\Exceptions;

class BadCountParametersException extends \InvalidArgumentException implements IException
{
    public function __construct($message = "", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}