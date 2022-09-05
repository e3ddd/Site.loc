<?php
include getRealPath("View/viewClass.php");
include getRealPath("requestClass.php");
include getRealPath("FileOperations.php");

$editItem = file_get_contents("templates/UserList/editItem.php");

$requests = Request::getInstance();

$requests->setOrder('PGC');

switch ($requests->action){
    case "Edit":
        $user = new EditOperations('a+', $user = ['email', 'password']);
        $newUser = new RenderPage($editItem);
        $newUser->setContent('email', $requests->email)
                 ->setContent('password', $requests->password);
        echo $newUser->render();
        $user->deleteFileDataItem(getRealPath('data/users.csv'), getRealPath("data/newUsers.csv"), $requests->email);
        break;

    case "Delete":
        $user = new EditOperations('a+', $user = ['email', 'password']);
        $user->deleteFileDataItem(getRealPath('data/users.csv'), getRealPath("data/newUsers.csv"), $requests->email);
        break;

    case "Ok":
        $user = new EditOperations('a+', $user = ['email', 'password']);
        if(!$user->existItem($requests->email, 'email', getRealPath("data/users.csv"))){
            $user->putToFile(getRealPath("data/users.csv"), [$requests->email, $requests->password]);
        }
        break;
}
