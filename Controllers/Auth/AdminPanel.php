<?php
include getRealPath("View/viewClass.php");
include getRealPath("requestClass.php");
include getRealPath("Pager.php");
include getRealPath("data/dataBase.php");

$layoutList = file_get_contents("templates/UserList/listLayout.php");
$listItem = file_get_contents("templates/UserList/listItem.php");
$actionBut = file_get_contents("templates/UserList/actionButUserList.php");
$pagerItemTemplate = file_get_contents("templates/UserList/pagerItem.php");
$pagerItemTemplateActive = file_get_contents("templates/UserList/pagerActiveItem.php");
$pagerTemplate = file_get_contents("templates/UserList/pager.php");
$searchField = file_get_contents("templates/UserList/searchField.php");
$homeLink = "index.php?page=Auth/AdminPanel";
$title = "Admin Panel";

$servername = "site.loc";
$username = "dev";
$password = "dev";
$dbname = "dev";


$requests = Request::getInstance();
$requests->setOrder('PGC');

$list = new RenderPage($layoutList);

$db = new DataBase("mysql:host=$servername;dbname=$dbname", $username, $password);

$user = $db->query("SELECT * FROM users");

$items = "";

$URL = parse_url($_SERVER['REQUEST_URI']);

parse_str($URL['query'] , $queryString);

$searchEmail = [];

if(!empty($requests->search)){
    foreach ($user as $key => $email){
        if(strncasecmp($email['email'], $requests->search, strlen($requests->search)) == 0){
            $searchEmail[] = [
                'email' => $email['email'],
                'password' => $email['password']
                ];
        }
    }
}


if(empty($requests->search)) {
    $pager = new Pager(
        count($user),
        10,
        (int)$queryString['num'] ?? 0
    );
}else{
    $pager = new Pager(
        count($searchEmail),
        10  ,
        (int)$queryString['num'] ?? 0
    );
    $user = $searchEmail;
}

$search = (new RenderPage($searchField))
    ->setContent('items', $searchField)
    ->render();

$pages = $pager->showPager($pagerTemplate, $pagerItemTemplate,$pagerItemTemplateActive,$requests->server("REQUEST_URI"), $queryString);

$currentNum = $pager->currentNum();

$users = $db->query("SELECT * FROM users LIMIT $pager->limit OFFSET $currentNum");

for ($i = 0; $i < $pager->countPages(); $i++) {
    $pageNum = $i * $pager->limit;
    if ($pageNum != $pager->limitNum()) {
        foreach ($users as $key => $user){
            $edit = (new RenderPage($actionBut))
                ->setContent('action', "index.php")
                ->setContent('method', "POST")
                ->setContent('value', "Auth/editUser")
                ->setContent('name', "Edit")
                ->setContent("email", $user['email'])
                ->setContent('num', $user['id'])
                ->render();
            $delete = (new RenderPage($actionBut))
                ->setContent('action', "index.php")
                ->setContent('method', "POST")
                ->setContent('value', "Auth/deleteUser")
                ->setContent('name', "Delete")
                ->setContent("email", $user['email'])
                ->setContent('num', $user['id'])
                ->render();

            $product = (new RenderPage($actionBut))
                ->setContent('action', "index.php")
                ->setContent('method', "GET")
                ->setContent('value', "Auth/ProductList")
                ->setContent('name', "Products")
                ->setContent("email", $user['email'])
                ->setContent("num", $user['id'])
                ->render();

            $item = new RenderPage($listItem);
            $item->setContent('email', $user['email'])
                ->setContent('password', $user['password'])
                ->setContent('edit', $edit)
                ->setContent('delete', $delete)
                ->setContent('product', $product);
            $items .= $item->render();
            if ($key == $pager->amountDataItems - 1) {
                break;
            }
        }
    }
}

$list->setContent('title', $title)
    ->setContent('search', $search)
    ->setContent('list', $items)
    ->setContent('pager', $pages)
    ->setContent('home' , $homeLink)
    ->setContent('num', $pager->getCurrentPage());

echo $list->render();