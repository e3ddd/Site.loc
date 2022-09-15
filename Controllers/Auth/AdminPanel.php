<?php
include getRealPath("View/viewClass.php");
include getRealPath("FileOperations.php");
include getRealPath("requestClass.php");
include getRealPath("Pager.php");


$layoutList = file_get_contents("templates/UserList/listLayout.php");
$listItem = file_get_contents("templates/UserList/listItem.php");
$actionBut = file_get_contents("templates/UserList/actionButUserList.php");
$pagerItemTemplate = file_get_contents("templates/UserList/pagerItem.php");
$pagerItemTemplateActive = file_get_contents("templates/UserList/pagerActiveItem.php");
$pagerTemplate = file_get_contents("templates/UserList/pager.php");
$searchField = file_get_contents("templates/UserList/searchField.php");
$homeLink = "index.php?page=Auth/AdminPanel";
$title = "Admin Panel";

$requests = Request::getInstance();
$requests->setOrder('PGC');

$list = new RenderPage($layoutList);
$users = new FileOperations("r", $user = ["num", "email", "password"]);

$user = $users->getFileData(getRealPath("data/users.csv"));
$products = new FileOperations('r', ['num', 'email', 'product', 'price', 'description']);

$items = "";

$URL = parse_url($_SERVER['REQUEST_URI']);

parse_str($URL['query'] , $queryString);

$pages = [];

$searchEmail = [];

$productsContent = [];

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
        count($users->getFileData(getRealPath("data/users.csv"))),
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


for ($i = 0; $i < $pager->countPages(); $i++) {
        $pageNum = $i * $pager->limit;
        if ($pageNum != $pager->limitNum()) {
            for ($j = $pager->currentNum(); $j < $pager->limitNum(); $j++) {
                $edit = (new RenderPage($actionBut))
                    ->setContent('action', "index.php")
                    ->setContent('method', "POST")
                    ->setContent('value', "Auth/editUser")
                    ->setContent('name', "Edit")
                    ->setContent("email", $user[$j]['email'])
                    ->setContent('num', $user[$j]['num'])
                    ->render();
                $delete = (new RenderPage($actionBut))
                    ->setContent('action', "index.php")
                    ->setContent('method', "POST")
                    ->setContent('value', "Auth/deleteUser")
                    ->setContent('name', "Delete")
                    ->setContent("email", $user[$j]['email'])
                    ->setContent('num', $user[$j]['num'])
                    ->render();

                $product = (new RenderPage($actionBut))
                    ->setContent('action', "index.php")
                    ->setContent('method', "GET")
                    ->setContent('value', "Auth/ProductList")
                    ->setContent('name', "Products")
                    ->setContent("email", $user[$j]['email'])
                    ->render();

                $item = new RenderPage($listItem);
                $item->setContent('email', $user[$j]['email'])
                    ->setContent('password', $user[$j]['password'])
                    ->setContent('edit', $edit)
                    ->setContent('delete', $delete)
                    ->setContent('product', $product);
                $items .= $item->render();
                if ($j == $pager->amountDataItems - 1) {
                    break;
                }
            }
        }
        break;
    }

$list->setContent('title', $title)
    ->setContent('search', $search)
    ->setContent('list', $items)
    ->setContent('pager', $pages)
    ->setContent('home' , $homeLink)
    ->setContent('num', $pager->getCurrentPage());

echo $list->render();