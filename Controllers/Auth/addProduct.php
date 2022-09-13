<?php
include getRealPath("requestClass.php");
include getRealPath("FileOperations.php");

$requests = Request::getInstance();

$requests->setOrder('GCP');


$getUserEmail = new FileOperations('r', $user = ['email', 'password']);

$getProduct = new FileOperations('r', ['email', 'product']);
$product = $getProduct->getFileData("data/products.csv");
$addProduct = new EditOperations('a+', ['email', 'product']);

if($getUserEmail->existItem($requests->email, 'email', getRealPath("data/users.csv"))){
    if($getProduct->existItem($requests->email, 'email', getRealPath("data/products.csv"))){
        $newProduct = "";
        foreach ($product as $item){
            if($item['email'] == $requests->email){
                $newProduct = $item['product'] . "," . $requests->product;
            }
        }
        $file = $addProduct->openFile("data/newProducts.csv");
        fclose($file);
        $addProduct->deleteFileDataItem("data/products.csv" , "data/newProducts.csv" , $requests->email);
        $addProduct->putToFile("data/products.csv", [$requests->email, $newProduct]);
        unset($newProduct);
    }else{
        $addProduct->putToFile("data/products.csv", [$requests->email, $requests->product]);
    }
}



