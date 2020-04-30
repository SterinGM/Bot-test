<?php
/**
 * Created by PhpStorm.
 * User: Grigoriy Sterin
 * Date: 29.04.2020
 */

namespace App\Exception;

use Exception;

class SessionNotValidException extends Exception
{
    public function __construct(string $sessionId)
    {
        parent::__construct(
            sprintf(
                'Session %s is not valid.', $sessionId
            )
        );
    }
}