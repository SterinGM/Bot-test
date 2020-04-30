<?php
/**
 * Created by PhpStorm.
 * User: Grigoriy Sterin
 * Date: 29.04.2020
 */

namespace App\Core;

abstract class View
{
    protected string $viewName;

    public function renderLayout(string $body): string
    {
        ob_start();
        require __DIR__ . '/../../templates/layout.php';
        return ob_get_clean();
    }

    public function render(array $params = []): string
    {
        extract($params);

        ob_start();
        require __DIR__ . '/../../templates/' . $this->viewName . '.php';
        $body = ob_get_clean();
        ob_end_clean();

        return $this->renderLayout($body);
    }
}