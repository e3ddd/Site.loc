<?php
include "../../index.php";
include getRealPath("requestClass.php");
include getRealPath("data/dataBase.php");

$servername = "site.loc";
$username = "dev";
$password = "dev";
$dbname = "dev";


$requests = Request::getInstance();
$requests->setOrder('GCP');

$db = new DataBase("mysql:host=$servername;dbname=$dbname", $username, $password);
$data = [];
foreach ($_REQUEST as $key => $val){
    $data = json_decode($key, true);
    break;
}
$email = str_replace("_", ".",$data['email']);
$password = $data['password'];


if(!empty($email) && !empty($password)){
    if($db->query("SELECT email FROM users WHERE email = ?", $email)){
        header('HTTP', true, 403);
    }else{
        if(preg_match("/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/", $email, $matches) !== 1){
            header('HTTP', true, 406);
        }else{
            if(strlen($password) < 6){
                header('HTTP', true, 400);
            }else{
                $stmt = $db->query("INSERT INTO users (email, password)
                VALUES (?,?)",$email,$password);
                return true;
            }
        }
    }

}else{
    header('HTTP', true, 404);
}

