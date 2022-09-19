<?php
include getRealPath("requestClass.php");
include getRealPath("FileOperations.php");
include getRealPath("data/dataBase.php");

$requests = Request::getInstance();

$requests->setOrder('PGC');

$db = new DataBase('site.loc', 'dev','dev','dev');


if(!empty($db->exist('users', 'email', $requests->email)->fetch_all())){
    $data = $db->db_query("SELECT email,password FROM users WHERE email = '$requests->email' ");
     foreach ($data->fetch_row() as $item){
         echo $item . "<br>";
     }
}else
{
 echo "Your user didn't found !";
}
