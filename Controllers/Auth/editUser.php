<?php
include getRealPath("View/viewClass.php");
include getRealPath("requestClass.php");
include getRealPath("data/dataBase.php");

$editItem = file_get_contents("templates/UserList/editItem.php");

$requests = Request::getInstance();

$requests->setOrder('PGC');

$db = new DataBase('site.loc', 'dev','dev','dev');

$users = $db->select('*', 'users');
$password = "";


foreach ($users as $user){
    if($user['email'] === $requests->email){
        $password = $user['password'];
    }
}

$newUser = new RenderPage($editItem);
$newUser->setContent('content', $requests->email)
    ->setContent('additional', $password)
    ->setContent('num', $requests->num)
    ->setContent('email', $requests->email)
    ->setContent('method', 'POST')
    ->setContent('action', "index.php?page=Auth/editUser");
echo $newUser->render();

    if($requests->action == "Ok"){
        if(empty($db->exist('users', 'email', $requests->content)->fetch_all())){
            $db->update('users', 'email', $requests->content, $requests->userNum);
        }else{
            echo "E-mail exist !";
        }
    }



