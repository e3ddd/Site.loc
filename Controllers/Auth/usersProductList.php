<?php

include getRealPath("View/viewClass.php");
include getRealPath("Pager.php");
include getRealPath("requestClass.php");
include getRealPath("data/dataBase.php");

$layoutList = file_get_contents("templates/UserPersonalArea/userProductsLayout.php");
$listItem = file_get_contents("templates/UserPersonalArea/userProductsItem.php");

$pagerItemTemplate = file_get_contents("templates/UserList/pagerItem.php");
$pagerItemTemplateActive = file_get_contents("templates/UserList/pagerActiveItem.php");
$pagerTemplate = file_get_contents("templates/UserList/pager.php");

$list = new RenderPage($layoutList);

$db = new DataBase('site.loc', 'dev', 'dev', 'dev');

$items = "";

$requests = Request::getInstance();
$requests->setOrder('PGC');


$url = parse_url($_SERVER['REQUEST_URI']);

parse_str($url['query'], $queryString);

$product = $db->select('*', 'products');

$pager = new Pager(
    count($product),
    8,
    (int)$queryString['num'] ?? 0
);


$pages = $pager->showPager($pagerTemplate, $pagerItemTemplate,$pagerItemTemplateActive,$requests->server("REQUEST_URI"), $queryString);

$currentNum = $pager->currentNum();

$products = $db->db_query("SELECT * FROM products LIMIT $pager->limit OFFSET $currentNum");

for ($i = 0; $i < $pager->countPages(); $i++) {
    $pageNum = $i * $pager->limit;
    if ($pageNum != $pager->limitNum()) {
        foreach ($products as $key => $product){
            $userId = $product['user_id'];
            $user = $db->db_query("SELECT email FROM users WHERE id = '$userId'");
            $item = new RenderPage($listItem);
            $item->setContent('image',"/assets/productImg/" . $product['img_name'])
                ->setContent('name', ucfirst($product['name']))
                ->setContent('user', $user->fetch_assoc()['email'])
                ->setContent('price', $product['price'])
                ->setContent('description', $product['description']);
            $items.= $item->render();
            if ($key == $pager->amountDataItems - 1) {
                break;
            }
        }
    }
    break;
}



$list->setContent('product', $items)
    ->setContent('pager', $pages)
    ->setContent('num', $pager->getCurrentPage());

echo $list->render();