<?php
include getRealPath("View/viewClass.php");
include getRealPath("requestClass.php");
include getRealPath("data/dataBase.php");

$servername = "site.loc";
$username = "dev";
$password = "dev";
$dbname = "dev";

$requests = Request::getInstance();
$requests->setOrder('PGC');

$db = new DataBase("mysql:host=$servername;dbname=$dbname", $username, $password);
$image = $db->query("SELECT * FROM productImages WHERE hash_id = ?", $requests->imgId);

$defaultImgLink = "assets/processedProductImg/" . $image[0]['user_id'] . "_" . $image[0]['product_id'] . "_" . $image[0]['hash_id'];
$smallImgLink = "assets/processedProductImg/" . $image[0]['user_id'] . "_" . $image[0]['product_id'] . "_SMALL_" . $image[0]['hash_id'];

if(unlink($defaultImgLink) && unlink($smallImgLink)){
    $db->query("DELETE FROM productImages WHERE hash_id = ?", $requests->imgId);
}
