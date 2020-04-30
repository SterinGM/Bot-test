<?php
/**
 * Created by PhpStorm.
 * User: Grigoriy Sterin
 * Date: 29.04.2020
 */

namespace App\Exception;

use Exception;

class InvalidCSRFTokenException extends Exception
{
    public function __construct(string $token)
    {
        parent::__construct(
            sprintf(
                'CSRF token %s is invalid.', $token
            )
        );
    }
}