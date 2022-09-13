<?php
include getRealPath("View/viewClass.php");
include getRealPath("requestClass.php");
include getRealPath("FileOperations.php");

$editItem = file_get_contents("templates/UserList/editItem.php");
$productListItem = file_get_contents("templates/ProductsList/productListItem.php");
$products = file_get_contents("templates/ProductsList/productItem.php");

$requests = Request::getInstance();

$requests->setOrder('PGC');

$user = new EditOperations('a+', $user = ['email', 'password']);
$newUser = new RenderPage($editItem);
$newUser->setContent('email', $requests->email)
    ->setContent('password', $requests->password)
    ->setContent('oldEmail', $requests->email);
echo $newUser->render();

if($requests->action == "Ok"){
    $user = new EditOperations('a+', $user = ['email', 'password']);
    if(!$user->existItem($requests->email, 'email', getRealPath("data/users.csv"))){
        if($user->deleteFileDataItem(getRealPath('data/users.csv'), getRealPath("data/newUsers.csv"), $requests->oldEmail)){
            $user->putToFile(getRealPath("data/users.csv"), [$requests->email, $requests->password]);
        }
    }else{
        echo "E-mail exist !";
    }
}