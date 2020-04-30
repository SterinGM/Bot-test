<?php
/**
 * Created by PhpStorm.
 * User: Grigoriy Sterin
 * Date: 29.04.2020
 */

namespace App\Controller;

use App\Core\Controller;
use App\Exception\InvalidLoginFormException;
use App\Model\UserModel;
use App\View\LoginView;
use Exception;

class UserController extends Controller
{
    private LoginView $view;
    private UserModel $model;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->view = new LoginView();
        $this->model = new UserModel();

        parent::__construct();
    }

    /**
     * @throws Exception
     */
    public function authAction()
    {
        $token = $this->generateCSRFToken();
        $error = $_SESSION['error'] ?? '';

        unset($_SESSION['error']);

        echo $this->view->render([
            'token' => $token,
            'error' => $error,
        ]);
    }

    public function loginAction()
    {
        $token = $_POST['token'] ?? null;
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;

        try {
            $this->checkCSRFToken($token);
            $this->validateLoginForm($username, $password);

            $user = $this->model->getUserByLoginAndPassword($username, $password);
            $this->model->updateSession($user, session_id());

            $_SESSION['user_id'] = $user->getId();
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();

            $this->redirect('/user/auth');
        }

        $this->redirect('/');
    }

    public function logoutAction()
    {
        $_SESSION = [];

        $this->closeSession();

        $this->redirect('/');
    }

    /**
     * @param string|null $username
     * @param string|null $password
     *
     * @return bool
     * @throws InvalidLoginFormException
     */
    private function validateLoginForm(?string $username, ?string $password): bool
    {
        if (empty($username) || empty($password)) {
            throw new InvalidLoginFormException();
        }

        return true;
    }
}