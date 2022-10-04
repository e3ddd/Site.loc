<?php

include getRealPath("requestClass.php");
include getRealPath("data/dataBase.php");
include getRealPath("View/viewClass.php");
include getRealPath("imgFunc.php");

$requests = Request::getInstance();
$requests->setOrder('PGC');

$servername = "site.loc";
$username = "dev";
$password = "dev";
$dbname = "dev";

$layoutList = file_get_contents("templates/UserProducts/productPageLayout.php");
$listItem = file_get_contents("templates/UserProducts/productPageItem.php");
$imgLayout = file_get_contents("templates/UserProducts/imagesCollection.php");
$smallItem = file_get_contents("templates/UserProducts/smallImg.php");

$db = new DataBase("mysql:host=$servername;dbname=$dbname", $username, $password);
$currentDate = date("Y-m-d");
$prodId = $requests->prodId;


$currentMin = date('i');
$currentHour = date('G');
$viewCounter = $db->query("SELECT * FROM viewCounter WHERE product_id = ? AND date = ?", $prodId, $currentDate);
$viewProductDate = $db->query("SELECT minute FROM viewCounter WHERE minute = ? AND product_id = ?", $currentMin, $prodId);
$viewProductId = $db->query("SELECT product_id FROM viewCounter WHERE product_id = ?", $prodId);


$products = $db->query("SELECT * FROM products WHERE id = ?", $prodId);
$images = $db->query("SELECT * FROM productImages WHERE product_id IN (".implode(",", array_column($products, 'id')).")");

$list = new RenderPage($layoutList);

foreach ($products as $key => $product){
    $userId = $product['user_id'];
    $user = $db->query("SELECT email FROM users WHERE id = ?", $product['user_id']);
    $item = new RenderPage($listItem);
    $smallImages = "";
    $imgitem = new RenderPage($imgLayout);
    foreach ($images as $key => $image){
        if($product['id'] == $image['product_id']){
            $defaultImgLink = $image['user_id'] . "_" . $image['product_id'] . "_" . $image['hash_id'];
            $smallImgLink = $image['user_id'] . "_" . $image['product_id'] . "_SMALL_" . $image['hash_id'];

            $imgitem->setContent('link', "assets/processedProductImg/" . $defaultImgLink)
                ->setContent('image', "assets/processedProductImg/" . $defaultImgLink);

            $smallImg = new RenderPage($smallItem);
            $smallImg->setContent('link', "assets/processedProductImg/" . $defaultImgLink)
                ->setContent('image', "assets/processedProductImg/" . $smallImgLink);
            $smallImages .= $smallImg->render();
        }
    }

    $img = $imgitem->setContent('smallImages', $smallImages)->render();
    unset($imgitem);


    $item->setContent('images', $img);


    $item
        ->setContent('action', "index.php?page=Auth/productViewStatistic")
        ->setContent('method', "post")
        ->setContent('id', $product['id'])
        ->setContent('name', ucfirst($product['name']))
        ->setContent('user', $user[0]['email'])
        ->setContent('price', $product['price'])
        ->setContent('description', $product['description']);
    $items.= $item->render();
 }





$list
    ->setContent('title', 'Product')
    ->setContent('product', $items);

echo $list->render();

if(empty($viewProductId)){
    $db->query("INSERT INTO viewCounter (date,hour,minute,product_id,count) VALUES (?,?,?,?,?)", $currentDate,$currentHour,$currentMin,$prodId,1);
}else{
    if($currentMin == $viewProductDate[0][0]){
        foreach ($viewCounter as $item){
            $count = $item['count'];
            $count++;
            $db->query("UPDATE viewCounter SET count = ? WHERE minute = ? AND product_id = ?", $count,$currentMin,$prodId);
        }
    }else{
        $db->query("INSERT INTO viewCounter (date,hour,minute,product_id,count) VALUES (?,?,?,?,?)", $currentDate,$currentHour,$currentMin,$prodId,1);
    }
}


