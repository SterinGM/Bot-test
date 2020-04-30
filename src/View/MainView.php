<?php
/**
 * Created by PhpStorm.
 * User: Grigoriy Sterin
 * Date: 29.04.2020
 */

namespace App\View;

use App\Core\View;

class MainView extends View
{
    /**
     * MainView constructor.
     */
    public function __construct()
    {
        $this->viewName = 'main';
    }
}