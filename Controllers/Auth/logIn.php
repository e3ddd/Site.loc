<?php
include getRealPath("View/viewClass.php");
include getRealPath("requestClass.php");
include getRealPath("data/dataBase.php");


$requests = Request::getInstance();
$requests->setOrder('GCP');

$db = new DataBase('site.loc', 'dev','dev','dev');
$users = $db->db_query("SELECT email,password FROM users WHERE email = '$requests->email' AND password = '$requests->password'");



    if($users->num_rows > 0){
        header("Location: index.php?page=Auth/userProductList&user=" . $requests->email);
    }else{
        echo "Password or email entered incorrectly !";
    }

