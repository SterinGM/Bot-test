<?php
/**
 * Created by PhpStorm.
 * User: Grigoriy Sterin
 * Date: 29.04.2020
 */

namespace App\Core;

class Router
{
    const DEFAULT_CONTROLLER = 'Main';
    const DEFAULT_ACTION = 'index';

    public function resolve(): array
    {
        $routes = explode('/', $_SERVER['REQUEST_URI'] ?? []);

        return [
            !empty($routes[1]) ? $routes[1] : self::DEFAULT_CONTROLLER,
            !empty($routes[2]) ? $routes[2] : self::DEFAULT_ACTION,
        ];
    }
}