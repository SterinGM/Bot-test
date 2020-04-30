<?php
/**
 * Created by PhpStorm.
 * User: Grigoriy Sterin
 * Date: 29.04.2020
 */

namespace App\Exception;

use Exception;

class AmountNotValidException extends Exception
{
    public function __construct(string $amount)
    {
        parent::__construct(
            sprintf(
                'Amount %s is not valid.', $amount
            )
        );
    }
}