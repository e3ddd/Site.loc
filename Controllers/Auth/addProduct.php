<?php
include getRealPath("requestClass.php");
include getRealPath("FileOperations.php");

$requests = Request::getInstance();

$requests->setOrder('GCP');


$getUserEmail = new FileOperations('r', $user = ['email', 'password']);

$getProduct = new FileOperations('r', ['user', 'product']);
$product = $getProduct->getFileData("data/products.csv");
$addProduct = new EditOperations('a+', [$requests->email, $requests->product]);




if($getUserEmail->existItem($requests->email, 'email', getRealPath("data/users.csv"))){
    if(!empty($product)){
        foreach ($product as $item){
            $newProduct = $item['product'] . "," . $requests->product;
        }
        $addProduct->deleteFileDataItem("data/products.csv" , "data/newProducts.csv" , $requests->email);
        $addProduct->putToFile("data/products.csv", [$requests->email, $newProduct]);
    }else{
        $addProduct->putToFile("data/products.csv", [$requests->email, $requests->product]);
    }
}



