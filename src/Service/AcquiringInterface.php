<?php
/**
 * Created by PhpStorm.
 * User: Grigoriy Sterin
 * Date: 29.04.2020
 */

namespace App\Service;

interface AcquiringInterface
{
    /**
     * @param float $amount
     */
    public function sendMoney(float $amount): void;
}