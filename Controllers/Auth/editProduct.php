<?php
include getRealPath("View/viewClass.php");
include getRealPath("requestClass.php");
include getRealPath("FileOperations.php");

$editItem = file_get_contents("templates/ProductsList/editItemProduct.php");

$requests = Request::getInstance();
$requests->setOrder('PGC');

$product = new FileOperations('r', ['num', 'email', 'product', 'price', 'description']);

$productContent = [];

foreach ($product->getFileData("data/products.csv") as $item){
    if($requests->num === $item['num']){
       $productContent['price'] = $item['price'];
       $productContent['description'] = $item['description'];
       $productContent['email'] = $item['email'];
    }
}

$newProduct = new RenderPage($editItem);
$newProduct
    ->setContent('product', $requests->product)
    ->setContent('price', $productContent['price'])
    ->setContent('description', $productContent['description'])
    ->setContent('num', $requests->num)
    ->setContent('email', $productContent['email'])
    ->setContent('method', 'POST')
    ->setContent('action', "index.php?page=Auth/editProduct");
echo $newProduct->render();


if($requests->action == "Ok"){
    $editProduct = new FileOperations("a+", ['num', 'email', 'product', 'price', 'description']);
    $file = $editProduct->openFile("data/newProducts.csv");
    fclose($file);
    $editProduct->deleteFileDataItem(getRealPath("data/products.csv"), getRealPath("data/newProducts.csv"), $requests->productNum, 'num');
    $editProduct->putToFile(getRealPath("data/products.csv"), [$requests->productNum, $requests->email, $requests->product, $requests->price, $requests->description]);
}


