<?php

namespace App\Exceptions;

class PasswordGrantClientNotFoundException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Password Grant Client Not Found!');
    }
}
