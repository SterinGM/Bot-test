<?php
/**
 * Created by PhpStorm.
 * User: Grigoriy Sterin
 * Date: 29.04.2020
 */

namespace App\Controller;

class ErrorController
{
    /**
     * @param array $data
     */
    public function error404Action(array $data): void
    {
        echo $data[0] ? $data[0]->getMessage() : '404 Page not found!!!';
    }

    /**
     * @param array $data
     */
    public function error500Action(array $data): void
    {
        echo $data[0] ? $data[0]->getMessage() : '500 Server error!!!';
    }
}