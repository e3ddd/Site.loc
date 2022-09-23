<?php

class DataBase
{
    private PDO $connection;

    private string $dsn = "";
    private string $username = "";
    private string $password = "";

    public function __construct(string $dsn, string $username, string $password){
        $this->dsn = $dsn;
        $this->username = $username;
        $this->password = $password;
        $this->connection_data_base();
    }

    public function connection_data_base(): void
    {
        $this->connection = new PDO($this->dsn, $this->username, $this->password);
    }

    public function query($sql, ...$params)
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}



