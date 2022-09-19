<?php
include getRealPath("requestClass.php");
include getRealPath("data/dataBase.php");


$requests = Request::getInstance();
$requests->setOrder('GCP');

$db = new DataBase('site.loc', 'dev', 'dev', 'dev');

if(empty($requests->email) || empty($requests->product) || empty($requests->price || empty($requests->description))){
    echo "Email or product not entered !";
}else{
    if(!$db->exist('users', 'email', $requests->email)->fetch_all()){
        echo "User doesn't exist!";
    }else{
        $db->db_query("INSERT INTO products (id,user,name,price,description) VALUES (0,'$requests->email', '$requests->product', '$requests->price', '$requests->description')");
    }
}






