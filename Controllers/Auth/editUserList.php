<?php
include getRealPath("scripts/AdminPanel/editUser.php");
include getRealPath("scripts/AdminPanel/deleteUser.php");
include getRealPath("View/viewClass.php");
include getRealPath("requestClass.php");

$editItem = file_get_contents("templates/UserList/editItem.php");

$requests = Request::getInstance();

$requests->setOrder('PGC');

switch ($requests->action){
    case "Edit":
        $user = editField($requests->email);
        $newUser = new RenderPage($editItem);
        $newUser->setContent('email', $user['email'])
                 ->setContent('password', $user['password']);
        echo $newUser->render();
        deleteEmail($user['email']);
        break;

    case "Delete":
        delete($requests->email);
        break;

    case "Ok":
        $user = [$requests->email, $requests->password];
        edit($user);
        break;

}