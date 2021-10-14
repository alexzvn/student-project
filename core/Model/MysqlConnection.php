<?php

namespace Core\Model;

use PDO;

class MySqlConnection
{
    protected $pdo;

    public function __construct(string $host = 'localhost', string $database, $user = 'root', $pass = null)
    {
        $this->open($host, $database, $user, $host);
    }

    public function __destruct()
    {
        $this->close();
    }

    private final function open($host, $database, $user, $pass)
    {
        $this->pdo = new PDO(
            "mysql:dbname=$database;host=$host", $user, $pass
        );
    }

    public final function execute($sql)
    {
        return $this->pdo->exec($sql);
    }

    public final function query($sql, array $params = [])
    {
        if (! empty($params)) {
            $sth = $this->pdo->prepare($sql);
            $sth->execute($params);
            return $sth;
        }

        return $this->pdo->query($sql);
    }

    private final function close()
    {
        $this->pdo = null;
    }
}
