<?php
/**
 * Created by PhpStorm.
 * User: Grigoriy Sterin
 * Date: 29.04.2020
 */

namespace App\Exception;

use Exception;

class InvalidLoginFormException extends Exception
{
    public function __construct()
    {
        parent::__construct(
            sprintf(
                'Login or password is empty.'
            )
        );
    }
}