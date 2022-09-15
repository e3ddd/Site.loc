<?php
include getRealPath("View/viewClass.php");
include getRealPath("requestClass.php");
include getRealPath("Pager.php");
include getRealPath("FileOperations.php");

$requests = Request::getInstance();
$requests->setOrder('PGC');

$layoutList = file_get_contents("templates/ProductsList/productListLayout.php");
$listItem = file_get_contents("templates/ProductsList/productListItem.php");
$productItem = file_get_contents("templates/ProductsList/productItem.php");
$actionBut = file_get_contents("templates/ProductsList/actionButProductsList.php");
$pagerItemTemplate = file_get_contents("templates/UserList/pagerItem.php");
$pagerItemTemplateActive = file_get_contents("templates/UserList/pagerActiveItem.php");
$pagerTemplate = file_get_contents("templates/UserList/pager.php");
$homeLink = "index.php?page=Auth/AdminPanel";
$title = "Product List";

$list = new RenderPage($layoutList);
$user = $requests->email;

$products = new FileOperations('r', ['num', 'email', 'product', 'price', 'description']);
$product = $products->getFileData("data/products.csv");

$items = "";

$URL = parse_url($_SERVER['REQUEST_URI']);

parse_str($URL['query'] , $queryString);

$pages = [];

$productsContent = [];

foreach ($product as $key => $item){
    if($item['email'] === $requests->email){
        $productsContent['num'][] = $item['num'];
        $productsContent['product'][] = $item['product'];
        $productsContent['price'][] = $item['price'];
        $productsContent['description'][] = $item['description'];
    }
}

$pager = new Pager(
    count($productsContent['product']),
    5,
    (int)$queryString['num'] ?? 0
);

$pages = $pager->showPager($pagerTemplate, $pagerItemTemplate,$pagerItemTemplateActive,$requests->server("REQUEST_URI"), $queryString);


$item = (new RenderPage($listItem))
    ->setContent('email', $user);

for ($i = 0; $i < $pager->countPages(); $i++) {
    $pageNum = $i * $pager->limit;
    if ($pageNum != $pager->limitNum()) {
        for ($j = $pager->currentNum(); $j < $pager->limitNum(); $j++) {
            $edit = (new RenderPage($actionBut))
                ->setContent('action', "index.php")
                ->setContent('method', "POST")
                ->setContent('value', "Auth/editProduct")
                ->setContent('name', "Edit")
                ->setContent('num', $productsContent['num'][$j])
                ->setContent('product', $productsContent['product'][$j])
                ->setContent('description', $productsContent['description'][$j])
                ->render();

            $delete = (new RenderPage($actionBut))
                ->setContent('action', "index.php")
                ->setContent('method', "POST")
                ->setContent('value', "Auth/deleteProduct")
                ->setContent('name', "Delete")
                ->setContent("num",$productsContent['num'][$j])
                ->render();

            $itemContent = (new RenderPage($productItem))
            ->setContent('product', $productsContent['product'][$j])
                ->setContent('price', $productsContent['price'][$j])
                ->setContent('description', $productsContent['description'][$j])
                ->setContent('edit', $edit)
                ->setContent('delete', $delete);
            $items .= $itemContent->render();
            if ($j == $pager->amountDataItems - 1) {
                break;
            }
        }
    }
    break;
}

$productListItem = (new RenderPage($listItem))
    ->setContent('email', $user)
    ->setContent('products', $items)
    ->render();



$list->setContent("title", $title)
    ->setContent('home', $homeLink)
    ->setContent('list', $productListItem)
    ->setContent('pager', $pages);

echo $list->render();