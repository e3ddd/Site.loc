<?php

include getRealPath("View/viewClass.php");
include getRealPath("requestClass.php");
include getRealPath("FileOperations.php");

$requests = Request::getInstance();
$requests->setOrder('PGC');

$products = new FileOperations("a+", ['num', 'email', 'products', 'price', 'description']);

$content = $products->getFileData("data/products.csv");

    foreach ($content as $item){
        if($requests->num == $item['num']){
            $productFile = $products->openFile("data/newProducts.csv");
            fclose($productFile);
            $products->deleteFileDataItem(getRealPath('data/products.csv'), getRealPath('data/newProducts.csv'), $requests->num, 'num');
        }
}