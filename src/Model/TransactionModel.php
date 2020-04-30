<?php
/**
 * Created by PhpStorm.
 * User: Grigoriy Sterin
 * Date: 29.04.2020
 */

namespace App\Model;

use App\Core\Model;
use App\Entity\User;

class TransactionModel extends Model
{
    /**
     * @param User $user
     * @param float $amount
     */
    public function create(User $user, float $amount): void
    {
        $this->db->execute('INSERT INTO transactions (user_id, amount) VALUES (:user_id, :amount)', [
            'user_id' => $user->getId(),
            'amount' => $amount,
        ]);
    }
}