<?php
include getRealPath("View/viewClass.php");
include getRealPath("FileOperations.php");

$layoutList = file_get_contents("templates/UserList/listLayout.php");
$listItem = file_get_contents("templates/UserList/listItem.php");
$title = "Admin Panel";


$list = new RenderPage($layoutList);
$users = new FileOperations("r", $user = ["email", "password"]);
$items = "";

foreach ($users->getFileData(getRealPath("data/users.csv")) as $user){
    $item = new RenderPage($listItem);
    $item->setContent('email', $user['email'])
        ->setContent('password', $user['password']);
    $items .=  $item->render();
}

$list->setContent('title', $title)
    ->setContent('list', $items);

echo $list->render();


