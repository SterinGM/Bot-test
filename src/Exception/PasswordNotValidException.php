<?php
/**
 * Created by PhpStorm.
 * User: Grigoriy Sterin
 * Date: 29.04.2020
 */

namespace App\Exception;

use Exception;

class PasswordNotValidException extends Exception
{
    public function __construct(string $login)
    {
        parent::__construct(
            sprintf(
                'Password for user %s is not valid.', $login
            )
        );
    }
}