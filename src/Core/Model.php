<?php
/**
 * Created by PhpStorm.
 * User: Grigoriy Sterin
 * Date: 29.04.2020
 */

namespace App\Core;

abstract class Model
{
    protected Db $db;

    public function __construct()
    {
        $this->db = new Db();
    }
}