<?php
/**
 * Created by PhpStorm.
 * User: Grigoriy Sterin
 * Date: 29.04.2020
 */

namespace App\Controller;

use App\Core\Controller;
use App\Core\Db;
use App\Entity\User;
use App\Exception\AmountNotValidException;
use App\Model\TransactionModel;
use App\Model\UserModel;
use App\Service\Acquiring;
use App\View\MainView;
use Exception;

class MainController extends Controller
{
    private Db $db;
    private MainView $view;
    private UserModel $userModel;
    private TransactionModel $transactionModel;

    /**
     * MainController constructor.
     */
    public function __construct()
    {
        $this->db = new Db();
        $this->view = new MainView();
        $this->userModel = new UserModel();
        $this->transactionModel = new TransactionModel();

        parent::__construct();
    }

    /**
     * @throws Exception
     */
    public function indexAction()
    {
        $user = $this->getAuthUser();
        $token = $this->generateCSRFToken();
        $error = $_SESSION['error'] ?? '';

        unset($_SESSION['error']);

        echo $this->view->render([
            'token' => $token,
            'error' => $error,
            'username' => $user->getLogin(),
            'balance' => $user->getDisplayBalance(),
        ]);
    }

    public function withdrawAction()
    {
        $user = $this->getAuthUser();
        $token = $_POST['token'] ?? null;
        $amount = $_POST['amount'] ?? null;

        $acquiring = new Acquiring();

        try {
            $this->db->pdo->beginTransaction();

            $this->checkCSRFToken($token);
            $this->validateAmount($user, $amount);

            $acquiring->sendMoney($amount);

            $this->userModel->changeBalance($user, $amount);
            $this->transactionModel->create($user, $amount);

            $this->db->pdo->commit();
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();

            $this->db->pdo->rollBack();
        }

        $this->redirect('/');
    }

    /**
     * @param User $user
     * @param string|null $amount
     *
     * @return bool
     * @throws AmountNotValidException
     */
    private function validateAmount(User $user, ?string $amount): bool
    {
        if (empty($amount) || !is_numeric($amount) || $amount < 0) {
            throw new AmountNotValidException($amount);
        }

        if ($user->getBalance() < $amount * 100) {
            throw new AmountNotValidException($amount);
        }

        return true;
    }
}