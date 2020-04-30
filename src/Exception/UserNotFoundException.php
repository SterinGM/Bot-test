<?php
/**
 * Created by PhpStorm.
 * User: Grigoriy Sterin
 * Date: 29.04.2020
 */

namespace App\Exception;

use Exception;

class UserNotFoundException extends Exception
{
    public function __construct(string $login)
    {
        parent::__construct(
            sprintf(
                'User %s not found.', $login
            )
        );
    }
}