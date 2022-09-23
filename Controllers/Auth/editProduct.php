<?php
include getRealPath("View/viewClass.php");
include getRealPath("requestClass.php");
include getRealPath("data/dataBase.php");

$servername = "site.loc";
$username = "dev";
$password = "dev";
$dbname = "dev";


$db = new DataBase("mysql:host=$servername;dbname=$dbname", $username, $password);

$products = $db->query("SELECT * FROM products");

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
    $user_id = "";
    foreach ($products as $product) {
        if ($product['id'] == $requests->productNum) {
            $user_id = $product['user_id'];
        }
    }
    $id = $requests->productNum;
    $name = $requests->product;
    $price = $requests->price;
    $description = $requests->description;
;
   $db->query("UPDATE products SET id = ?, user_id = ?, name = ?, price = ?, description = ? WHERE id = ?", $id, $user_id,$name, $price, $description, $id);
}


