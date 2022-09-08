<?php
include getRealPath("View/viewClass.php");
include getRealPath("FileOperations.php");
include getRealPath("requestClass.php");
include getRealPath("Pager.php");


$layoutList = file_get_contents("templates/UserList/listLayout.php");
$listItem = file_get_contents("templates/UserList/listItem.php");
$pageButtons = file_get_contents("templates/UserList/pageBut.php");
$pagerItemTemplate = file_get_contents("templates/UserList/pagerItem.php");
$pagerTemplate = file_get_contents("templates/UserList/pager.php");
$title = "Admin Panel";

$requests = Request::getInstance();
$requests->setOrder('PGC');

$list = new RenderPage($layoutList);
$users = new FileOperations("r", $user = ["email", "password"]);
$user = $users->getFileData(getRealPath("data/users.csv"));
$items = "";

$URL = parse_url($_SERVER['REQUEST_URI']);

parse_str($URL['query'] , $queryString);

$pager = new Pager(
    count($users->getFileData(getRealPath("data/users.csv"))),
    10,
        $queryString['num'] ?? 0
);

//var_dump( $pager->generateURL("page=" . $URL['scheme'], 123));
//exit;

$pages = [];

if ($pager->hasPrevPage()) {
    $pages[] = (new RenderPage($pagerItemTemplate))
        ->setContent('URL', $URL['path'] . "?" . $pager->generateURL("page=" . $queryString['page'], $queryString['num'] - 1))
        ->setContent('TITLE', 'Prev')
        ->render();
}

for($i=0; $i<$pager->countPages(); $i++) {
    $pages[] = (new RenderPage($pagerItemTemplate))
        ->setContent('URL', $URL['path'] . "?" . $pager->generateURL("page=" . $queryString['page'], $i))
        ->setContent('TITLE', $i + 1)
        ->render();
}

if ($pager->hasNextPage()) {
    $pages[] = (new RenderPage($pagerItemTemplate))
        ->setContent('URL', $URL['path'] . "?" . $pager->generateURL("page=" . $queryString['page'], $queryString['num'] + 1))
        ->setContent('TITLE', 'Next')
        ->render();
}


$pages = (new RenderPage($pagerTemplate))
    ->setContent(
        'items',
        implode('', $pages)
    )
    ->render();

for($i=0; $i<$pager->countPages(); $i++) {
    $pageNum = $i * $pager->limit;
    if ($pageNum != $pager->limitNum()) {
        for ($j = $pager->currentNum(); $j < $pager->limitNum(); $j++) {
            $item = new RenderPage($listItem);
            $item->setContent('email', $user[$j]['email'])
                ->setContent('password', $user[$j]['password']);
            $items .= $item->render();
            if ($j == $pager->amountDataItems - 1) {
                break;
            }
        }
    }
    break;
}


$list->setContent('title', $title)
    ->setContent('list', $items)
    ->setContent('pager', $pages)
    ->setContent('num', $pager->getCurrentPage());

echo $list->render();

