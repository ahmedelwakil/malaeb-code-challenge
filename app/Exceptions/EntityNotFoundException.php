<?php

namespace App\Exceptions;

class EntityNotFoundException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Entity Not Found!');
    }
}
