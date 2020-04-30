<?php
/**
 * Created by PhpStorm.
 * User: Grigoriy Sterin
 * Date: 29.04.2020
 */

namespace App\Core;

use PDO;

class Db
{
    public PDO $pdo;

    public function __construct()
    {
        $settings = $this->getSettings();
        $this->pdo = new PDO($settings['dsn'], $settings['user'], $settings['pass'], null);
    }

    protected function getSettings(): array
    {
        $config = include __DIR__ . '/../Config/Db.php';

        $result['dsn'] = "{$config['type']}:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";
        $result['user'] = $config['user'];
        $result['pass'] = $config['pass'];

        return $result;
    }

    public function execute($query, array $params = null)
    {
        $stmt = $this->prepareQuery($query, $params);

        return $stmt->fetchAll();
    }

    public function findOne($query, string $class, array $params = null)
    {
        $stmt = $this->prepareQuery($query, $params);

        return $stmt->fetchObject($class);
    }

    private function prepareQuery($query, array $params = null)
    {
        if (is_null($params)) {
            $stmt = $this->pdo->query($query);
        } else {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
        }

        return $stmt;
    }
}