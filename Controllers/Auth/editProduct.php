<?php
include getRealPath("View/viewClass.php");
include getRealPath("requestClass.php");
include getRealPath("data/dataBase.php");

$db = new DataBase('site.loc', 'dev', 'dev', 'dev');

$product = $db->select('*', 'products');

$editItem = file_get_contents("templates/ProductsList/editItemProduct.php");

$requests = Request::getInstance();
$requests->setOrder('PGC');

$newProduct = new RenderPage($editItem);
$newProduct
    ->setContent('product', $requests->product)
    ->setContent('price', $requests->price)
    ->setContent('description', $requests->description)
    ->setContent('num', $requests->num)
    ->setContent('method', 'POST')
    ->setContent('action', "index.php?page=Auth/editProduct");
echo $newProduct->render();


if($requests->action == "Ok"){
        $db->update('products', 'name', $requests->product, $requests->productNum);
        $db->update('products', 'price', $requests->price, $requests->productNum);
        $db->update('products', 'description', $requests->description, $requests->productNum);
}


