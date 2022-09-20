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
        $users = $db->select('*', 'users');
        $id = "";
        foreach ($users as $user){
            if($requests->email === $user['email']){
                $id = $user['id'];
                break;
            }
        }
        $img = "";
        foreach (scandir(getRealPath("assets/productImg")) as $image){
           if(preg_match("@^$id\_$requests->product.\w{3}@", $image, $matches)){
               $img = $image;
            }
        }
        $db->db_query("INSERT INTO products (id,user_id,name,price,description,img_name) VALUES (0,'$id', '$requests->product', '$requests->price', '$requests->description','$img')");
    }
}






