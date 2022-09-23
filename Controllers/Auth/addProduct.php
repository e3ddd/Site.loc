<?php
include getRealPath("requestClass.php");
include getRealPath("data/dataBase.php");

$servername = "site.loc";
$username = "dev";
$password = "dev";
$dbname = "dev";


$db = new DataBase("mysql:host=$servername;dbname=$dbname", $username, $password);

$requests = Request::getInstance();
$requests->setOrder('GCP');
$users = $db->query("SELECT * FROM users");
$id = 0;

if(empty($requests->email) || empty($requests->product) || empty($requests->price) || empty($requests->description)){
    echo "Email or product not entered !";
}else {
    foreach ($users as $user){
        if($requests->email == $user['email']){
            $user_id = $user['id'];
            $name = $requests->product;
            $price = $requests->price;
            $description = $requests->description;
            $db->query("INSERT INTO products VALUES (?,?,?,?,?)", $id,$user_id,$name,$price,$description);
            break;
        }
    }
}






