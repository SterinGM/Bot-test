<?php
/**
 * Created by PhpStorm.
 * User: Grigoriy Sterin
 * Date: 29.04.2020
 */

namespace App;

use App\Core\Router;
use App\Exception\InvalidRouteException;
use Throwable;

class Kernel
{
    public Router $router;

    /**
     * @return Kernel
     */
    public static function init(): Kernel
    {
        set_exception_handler(['App\Kernel', 'handleException']);

        $kernel = new self();

        $kernel->router = new Router();

        return $kernel;
    }

    /**
     * @throws InvalidRouteException
     */
    public function run(): void
    {
        $routes = $this->router->resolve();

        self::launchAction(ucfirst(strtolower($routes[0])), strtolower($routes[1]));
    }

    /**
     * @param Throwable $e
     *
     * @throws InvalidRouteException
     */
    public function handleException(Throwable $e)
    {
        if ($e instanceof InvalidRouteException) {
            header('HTTP/1.1 404 Not Found');
            header("Status: 404 Not Found");

            self::launchAction('Error', 'error404', [$e]);
        } else {
            header('HTTP/1.1 500 Server Error');
            header("Status: 500 Server Error");

            self::launchAction('Error', 'error500', [$e]);
        }
    }

    /**
     * @param string $controllerName
     * @param string $action
     * @param null $params
     *
     * @throws InvalidRouteException
     */
    public static function launchAction(string $controllerName, string $action, $params = null)
    {
        $controllerName = 'App\\Controller\\' . $controllerName . 'Controller';
        $action .= 'Action';

        if (class_exists($controllerName) && method_exists($controllerName, $action)) {
            $controller = new $controllerName;
            $controller->$action($params);
        } else {
            throw new InvalidRouteException($_SERVER['REQUEST_URI'] ?? []);
        }
    }
}