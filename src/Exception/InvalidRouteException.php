<?php
/**
 * Created by PhpStorm.
 * User: Grigoriy Sterin
 * Date: 29.04.2020
 */

namespace App\Exception;

use Exception;

class InvalidRouteException extends Exception
{
    public function __construct(string $route)
    {
        parent::__construct(
            sprintf(
                'Route %s not found.', $route
            )
        );
    }
}