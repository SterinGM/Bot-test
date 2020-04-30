<?php
/**
 * Created by PhpStorm.
 * User: Grigoriy Sterin
 * Date: 29.04.2020
 */

namespace App\View;

use App\Core\View;

class LoginView extends View
{
    /**
     * LoginView constructor.
     */
    public function __construct()
    {
        $this->viewName = 'login';
    }
}