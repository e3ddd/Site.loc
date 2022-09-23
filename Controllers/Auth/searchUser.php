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

$users = $db->query("SELECT email,password FROM users WHERE email = ?", $email);

if($users){
    foreach ($users as $user){
       echo $user['email'] . "<br>";
       echo $user['password'] . "<br>";
    }
}else{
    echo "Your e-mail don't found !";
}



