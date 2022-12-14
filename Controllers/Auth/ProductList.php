<?php
include getRealPath("View/viewClass.php");
include getRealPath("requestClass.php");
include getRealPath("Pager.php");
include getRealPath("data/dataBase.php");


$requests = Request::getInstance();
$requests->setOrder('PGC');

$servername = "site.loc";
$username = "dev";
$password = "dev";
$dbname = "dev";


$db = new DataBase("mysql:host=$servername;dbname=$dbname", $username, $password);

$layoutList = file_get_contents("templates/ProductsList/productListLayout.php");
$listItem = file_get_contents("templates/ProductsList/productListItem.php");
$imageList = file_get_contents("templates/ProductsList/imagesList.php");
$imageInput = file_get_contents("templates/ProductsList/imgsinput.php");
$productItem = file_get_contents("templates/ProductsList/productItem.php");
$actionBut = file_get_contents("templates/ProductsList/actionButProductsList.php");
$pagerItemTemplate = file_get_contents("templates/UserList/pagerItem.php");
$pagerItemTemplateActive = file_get_contents("templates/UserList/pagerActiveItem.php");
$pagerTemplate = file_get_contents("templates/UserList/pager.php");
$homeLink = "index.php?page=Auth/AdminPanel";
$title = "Product List";

$list = new RenderPage($layoutList);
$user = $requests->email;

$product = $db->query("SELECT * FROM products");
$images = $db->query("SELECT * FROM productImages");
$num = 0;
foreach ($product as $item){
    if($item['user_id'] === $requests->num){
        $num++;
    }
}
$items = "";

$URL = parse_url($_SERVER['REQUEST_URI']);

parse_str($URL['query'] , $queryString);

$pager = new Pager(
        $num,
    5,
    (int)$queryString['num'] ?? 0
);

$pages = $pager->showPager($pagerTemplate, $pagerItemTemplate,$pagerItemTemplateActive,$requests->server("REQUEST_URI"), $queryString);

$currentNum = $pager->currentNum();

if(!empty($db->query("SELECT user_id FROM products WHERE user_id = ?", $requests->num))){
    $prod = $db->query("SELECT * FROM products WHERE user_id = '$requests->num' LIMIT $pager->limit OFFSET $currentNum ");
}

$item = (new RenderPage($listItem))
    ->setContent('email', $requests->email);


for ($i = 0; $i < $pager->countPages(); $i++) {
    $pageNum = $i * $pager->limit;
    if ($pageNum != $pager->limitNum()) {
        foreach ($prod as $key => $product){
            if($requests->num === $product['user_id']){
                $img = "";
                $imgId = [];
                $delete = new RenderPage($actionBut);
                foreach ($images as $image) {
                    if ($product['id'] == $image['product_id']){
                        $imgId[] = $image['id'];
                    }
                    $img = implode(',', $imgId);
                }

                $edit = (new RenderPage($actionBut))
                    ->setContent('action', "index.php")
                    ->setContent('method', "POST")
                    ->setContent('value', "Auth/editProduct")
                    ->setContent('name', "Edit")
                    ->setContent('num', $product['id'])
                    ->setContent('price', $product['price'])
                    ->setContent('product', $product['name'])
                    ->setContent('description', $product['description'])
                    ->setContent('images', $img)
                    ->render();

                $delete->setContent('action', "index.php")
                    ->setContent('method', "POST")
                    ->setContent('value', "Auth/deleteProduct")
                    ->setContent('name', "Delete")
                    ->setContent("num",$product['id']);

                $del = $delete->render();

                $itemContent = (new RenderPage($productItem))
                    ->setContent('product',  $product['name'])
                    ->setContent('price',  $product['price'])
                    ->setContent('description', $product['description'])
                    ->setContent('edit', $edit)
                    ->setContent('delete', $del);

                $items .= $itemContent->render();
                if ($key == $pager->amountDataItems - 1) {
                    break;
                }
                }
            }
        }
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