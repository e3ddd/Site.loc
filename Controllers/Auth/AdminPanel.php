<?php
include getRealPath("View/viewClass.php");
include getRealPath("FileOperations.php");
include getRealPath("requestClass.php");
include getRealPath("Pager.php");


$layoutList = file_get_contents("templates/UserList/listLayout.php");
$listItem = file_get_contents("templates/UserList/listItem.php");
$pageButtons = file_get_contents("templates/UserList/pageBut.php");
$title = "Admin Panel";

$requests = Request::getInstance();
$requests->setOrder('PGC');

$list = new RenderPage($layoutList);
$users = new FileOperations("r", $user = ["email", "password"]);
$user = $users->getFileData(getRealPath("data/users.csv"));
$page = new Pager(count($users->getFileData(getRealPath("data/users.csv"))), 10);
$items = "";


for ($i=0;$i<$page->countPages();$i++){
        for($j=$page->currentNum($i);$j<$page->limit*($i+1);$j++){
            $item = new RenderPage($listItem);
            $item->setContent('email', $user[$j]['email'])
                ->setContent('password', $user[$j]['password']);
            $items .=  $item->render();
    }
        break;
}

 $list->setContent('title', $title)
     ->setContent('list', $items)
     ->setContent('pageButtons', $pageButtons);

 echo $list->render();

