<?php

class DataBase
{
    private mysqli $connection;

    private string $hostname = "";
    private string $username = "";
    private string $password = "";
    private string $databaseName = "";

    public function __construct(string $hostname, string $username, string $password, string $databaseName){
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->databaseName = $databaseName;
        $this->connection_data_base();
    }

    public function connection_data_base(): void
    {
        $this->connection = new mysqli($this->hostname, $this->username, $this->password, $this->databaseName);
    }

    public function exist($table_name, $column, $needle)
    {
       return $this->connection->query("SELECT * FROM $table_name
       WHERE EXISTS(SELECT $column FROM $table_name WHERE $column = '$needle')
       ");
    }

    public function select($column, $table_name): array
    {
        $data = $this->connection->query("SELECT " . $column . " FROM " . $table_name);
        $items = [];
        for ($i=0;$i<$data->num_rows;$i++){
            if($column = "*"){
                $items[] = $data->fetch_assoc();
            }else{
                $items[] = $data->fetch_assoc()[$column];
            }
        }
        return $items;
    }

    public function update($table_name, $column, $value, $num)
    {
       return $this->connection->query("UPDATE $table_name
        SET $column = '$value'
        WHERE id = $num
        ");
    }

    public function delete($table_name, $num)
    {
        return $this->connection->query("DELETE FROM $table_name WHERE id = $num");
    }

    public function db_query($query): mysqli_result|bool
    {
        return $this->connection->query($query);
    }
}



