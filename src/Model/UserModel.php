<?php
/**
 * Created by PhpStorm.
 * User: Grigoriy Sterin
 * Date: 29.04.2020
 */

namespace App\Model;

use App\Core\Model;
use App\Entity\User;
use App\Exception\PasswordNotValidException;
use App\Exception\SessionNotValidException;
use App\Exception\UserNotFoundException;

class UserModel extends Model
{
    /**
     * @param int $id
     * @param string $sessionId
     *
     * @return User
     * @throws UserNotFoundException
     * @throws SessionNotValidException
     */
    public function getAuthUserByIdAndSession(int $id, string $sessionId): User
    {
        /** @var User $user */
        $user = $this->db->findOne('SELECT * FROM users WHERE id = :id', User::class, [
            'id' => $id
        ]);

        if (empty($user)) {
            throw new UserNotFoundException('ID: ' . $id);
        }

        if ($user->getSessionId() !== $sessionId) {
            throw new SessionNotValidException($sessionId);
        }

        return $user;
    }

    /**
     * @param string $username
     * @param string $password
     *
     * @return User
     * @throws UserNotFoundException
     * @throws PasswordNotValidException
     */
    public function getUserByLoginAndPassword(string $username, string $password): User
    {
        /** @var User $user */
        $user = $this->db->findOne('SELECT * FROM users WHERE login = :login', User::class, [
            'login' => $username
        ]);

        if (empty($user)) {
            throw new UserNotFoundException($username);
        }

        if (false === password_verify($password, $user->getPassword())) {
            throw new PasswordNotValidException($username);
        }

        return $user;
    }

    /**
     * @param User $user
     * @param string $sessionId
     */
    public function updateSession(User $user, string $sessionId): void
    {
        $this->db->execute('UPDATE users SET session_id = :session_id WHERE id = :id', [
            'id' => $user->getId(),
            'session_id' => $sessionId,
        ]);
    }

    /**
     * @param User $user
     * @param float $amount
     */
    public function changeBalance(User $user, float $amount): void
    {
        $amount = round($amount * 100);

        $this->db->execute('UPDATE users SET balance = balance - :amount WHERE id = :id', [
            'id' => $user->getId(),
            'amount' => $amount,
        ]);
    }
}