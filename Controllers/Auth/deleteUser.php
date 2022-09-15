<?php
include getRealPath("View/viewClass.php");
include getRealPath("requestClass.php");
include getRealPath("FileOperations.php");

$requests = Request::getInstance();
$requests->setOrder('PGC');

$user = new FileOperations('a+', $user = ['num', 'email', 'password']);
$product = new FileOperations('a+', $product = ['num', 'email', 'product','price', 'description']);

$file = $user->openFile("data/newUsers.csv");
fclose($file);
$productFile = $user->openFile("data/newProducts.csv");
fclose($productFile);

if($user->deleteFileDataItem(getRealPath('data/users.csv'), getRealPath("data/newUsers.csv"), $requests->num, 'num')){
    foreach ($product->getFileData("data/products.csv") as $item){
        if($requests->email == $item['email']){
            $product->deleteFileDataItem(getRealPath('data/products.csv'), getRealPath('data/newProducts.csv'), $requests->email, 'email');
        }
    }
}