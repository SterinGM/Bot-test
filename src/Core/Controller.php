<?php
/**
 * Created by PhpStorm.
 * User: Grigoriy Sterin
 * Date: 29.04.2020
 */

namespace App\Core;

use App\Entity\User;
use App\Exception\InvalidCSRFTokenException;
use App\Model\UserModel;
use Exception;

abstract class Controller
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * @return User|null
     */
    public function getAuthUser(): ?User
    {
        if (empty($_SESSION['user_id'])) {
            $this->redirect('/user/auth');
        }

        try {
            $user = $this->userModel->getAuthUserByIdAndSession($_SESSION['user_id'], session_id());

            return $user;
        } catch (Exception $exception) {
            $this->redirect('/user/auth');
        }

        return null;
    }

    /**
     * @param string $route
     */
    public function redirect(string $route)
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'];

        header("Status: 302 Redirect");
        header('Location:' . $host . $route);

        exit;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function generateCSRFToken(): string
    {
        $_SESSION['token'] = bin2hex(random_bytes(32));

        return $_SESSION['token'];
    }

    /**
     * @param string $token
     *
     * @return bool
     * @throws InvalidCSRFTokenException
     */
    public function checkCSRFToken(string $token): bool
    {
        if ($token !== $_SESSION['token']) {
            throw new InvalidCSRFTokenException($token);
        }

        return true;
    }

    public function closeSession()
    {
        session_write_close();
    }
}