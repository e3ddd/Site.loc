<?php
include getRealPath("requestClass.php");
include getRealPath("data/dataBase.php");

$servername = "site.loc";
$username = "dev";
$password = "dev";
$dbname = "dev";


$requests = Request::getInstance();
$requests->setOrder('GCP');

$db = new DataBase("mysql:host=$servername;dbname=$dbname", $username, $password);
$id = 0;
$email = $requests->email;
$password = $requests->password;
    if($db->query("SELECT email FROM users WHERE email = ?", $email)){
        echo "Your e-mail exist !";
    }else{
        $stmt = $db->query("INSERT INTO users (id, email, password)
                VALUES (?,?,?)", $id,$email,$password);
        echo "New records created successfully";
    }

