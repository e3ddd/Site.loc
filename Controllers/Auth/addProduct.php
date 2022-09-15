<?php
include getRealPath("requestClass.php");
include getRealPath("FileOperations.php");

$requests = Request::getInstance();

$requests->setOrder('GCP');

$num = mt_rand(1,999);

$getProductData = new FileOperations("r", $buyer = [$num, $requests->email, $requests->product, $requests->price, $requests->description]);
$products = $getProductData->getFileData("data/products.csv");

foreach ($products as $product){
  if($buyer['num'] === $product['num']){
      $num = mt_rand(1,999);
  }
}


$addProduct = new FileOperations("a+",
    $product = [$num, $requests->email, $requests->product, $requests->price, $requests->description]);

$getUsersData = new FileOperations("r",
    ['num', 'email', 'password']);



if(empty($requests->email) || empty($requests->product) || empty($requests->price || empty($requests->description))){
    echo "Email or product not entered !";
}else{
    if(!$getUsersData->existItem($requests->email, 'email', getRealPath("data/users.csv"))){
        echo "User doesn't exist!";
    }else{
        $addProduct->putToFile(getRealPath("data/products.csv"), $product);
    }
}






