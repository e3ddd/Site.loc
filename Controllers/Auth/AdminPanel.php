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
$items = "";

$URL = parse_url($_SERVER['REQUEST_URI']);

$URL = str_split($URL['query'] , 1);

$numPage = array_pop($URL);

$pager = new Pager(count($users->getFileData(getRealPath("data/users.csv"))), 10, $numPage);

for($i=0; $i<$pager->countPages(); $i++){
    $pageNum = $i * $pager->limit;
    if($pageNum != $pager->limitNum()){
        for($j=$pager->currentNum(); $j<$pager->limitNum(); $j++){
            $item = new RenderPage($listItem);
            $item->setContent('email', $user[$j]['email'])
                ->setContent('password', $user[$j]['password']);
            $items .=  $item->render();
            if($j == $pager->amountDataItems - 1){
                break;
            }
        }
    }
    break;
}

switch ($requests->action){

    case "Next >>":
        if($pager->hasNextPage($numPage)){
            $numPage++;
        }else{
            $numPage = $pager->countPages()-1;
        }
        break;

    case "<< Prev":
        if(!$pager->hasPrevPage($numPage)){
            $numPage--;
        }else{
            $numPage = 0;
        }
        break;

}

$list->setContent('title', $title)
    ->setContent('list', $items)
    ->setContent('pageButtons', $pageButtons)
    ->setContent('num', $numPage);
//    ->setContent('pagenumber', $numPage + 1);



echo $list->render();
