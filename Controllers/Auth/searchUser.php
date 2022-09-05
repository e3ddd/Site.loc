<?php
include getRealPath("requestClass.php");
include getRealPath("FileOperations.php");

$requests = Request::getInstance();

$requests->setOrder('PGC');

$search =  new FileOperations("r",
    $user = ['email', 'password']);

if($search->existItem($requests->email, 'email', getRealPath("data/users.csv"))){
    foreach ($search->existItem($requests->email, 'email', getRealPath("data/users.csv")) as $user){
        echo $user . "<br>";
    }
}else{
    echo "User didn't found !";
}

