<?php
/**
 * Created by PhpStorm.
 * User: Grigoriy Sterin
 * Date: 29.04.2020
 */

namespace App\Entity;

class User
{
    private int $id;
    private string $login;
    private string $password;
    private int $balance;
    private ?string $session_id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return int
     */
    public function getBalance(): int
    {
        return $this->balance;
    }

    /**
     * @param int $balance
     */
    public function setBalance(int $balance): void
    {
        $this->balance = $balance;
    }

    /**
     * @return string
     */
    public function getDisplayBalance(): string
    {
        return number_format(round($this->balance / 100, 2), 2);
    }

    /**
     * @return string|null
     */
    public function getSessionId(): ?string
    {
        return $this->session_id;
    }

    /**
     * @param string|null $session_id
     */
    public function setSessionId(?string $session_id): void
    {
        $this->session_id = $session_id;
    }
}