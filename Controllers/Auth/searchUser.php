<?php
include getRealPath("scripts/RegAndSearchScripts/form.php");
include getRealPath("requestClass.php");

$requests = Request::getInstance();

$requests->setOrder('PGC');

$search = searchUser($requests->email);

if(is_array($search)){
    foreach ($search as $user){
        echo $user . "<br>";
    }
}else{
    echo "User didn't found !";
}

