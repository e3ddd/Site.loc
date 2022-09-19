<?php
include getRealPath("requestClass.php");
include getRealPath("FileOperations.php");
include getRealPath("data/dataBase.php");


$requests = Request::getInstance();
$requests->setOrder('GCP');

$db = new DataBase('site.loc', 'dev','dev','dev');

if(!empty($db->exist('users', 'email', $requests->email)->fetch_all())){
    echo "Your e-mail exist !";
}else{
    $db->db_query("INSERT INTO users (id,email,password) VALUES (0,'$requests->email', '$requests->password')");
}