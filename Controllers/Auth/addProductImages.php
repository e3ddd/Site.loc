<?php
include getRealPath("requestClass.php");
include getRealPath("data/dataBase.php");
include getRealPath("imgFunc.php");

$requests = Request::getInstance();
$requests->setOrder('GCP');

$servername = "site.loc";
$username = "dev";
$password = "dev";
$dbname = "dev";


$db = new DataBase("mysql:host=$servername;dbname=$dbname", $username, $password);

$productId = $requests->productId;

$userId = $db->query("SELECT id FROM users WHERE email = ?", $requests->email);

if($db->query("SELECT id FROM products WHERE id = ?", $productId)){
    $hash_id = hash('md5', $requests->files('fileToUpload')['name']);
    $defaultImg = $userId[0]['id'] . "_" . $productId . "_" . $hash_id;
    $smallImg = $userId[0]['id'] . "_" . $productId . "_SMALL_" . $hash_id;
    if($db->query("SELECT hash_id FROM productImages WHERE hash_id = ?", $hash_id)){
        echo "Photo exist !";
    }else{
        if (processe("assets/processedProductImg/" . $defaultImg, "assets/productImg/" . $requests->files('fileToUpload')['name'], 220,200)){
            if(processe("assets/processedProductImg/" . $smallImg, "assets/productImg/" . $requests->files('fileToUpload')['name'], 75,55)){
                $db->query("INSERT INTO productImages (hash_id, product_id, user_id) VALUES (?,?,?)" ,$hash_id,$productId,$userId[0]['id']);
            }
        }
    }
}


