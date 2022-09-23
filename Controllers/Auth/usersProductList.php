<?php

include getRealPath("View/viewClass.php");
include getRealPath("imgFunc.php");
include getRealPath("Pager.php");
include getRealPath("requestClass.php");
include getRealPath("data/dataBase.php");

$layoutList = file_get_contents("templates/UserPersonalArea/userProductsLayout.php");
$listItem = file_get_contents("templates/UserPersonalArea/userProductsItem.php");
$imgLayout = file_get_contents("templates/UserPersonalArea/imagesCollection.php");
$smallItem = file_get_contents("templates/UserPersonalArea/smallImg.php");

$pagerItemTemplate = file_get_contents("templates/UserList/pagerItem.php");
$pagerItemTemplateActive = file_get_contents("templates/UserList/pagerActiveItem.php");
$pagerTemplate = file_get_contents("templates/UserList/pager.php");

$list = new RenderPage($layoutList);

$servername = "site.loc";
$username = "dev";
$password = "dev";
$dbname = "dev";


$db = new DataBase("mysql:host=$servername;dbname=$dbname", $username, $password);

$items = "";

$requests = Request::getInstance();
$requests->setOrder('PGC');


$url = parse_url($_SERVER['REQUEST_URI']);

parse_str($url['query'], $queryString);

$product = $db->query("SELECT * FROM products");

$pager = new Pager(
    count($product),
    8,
    (int)$queryString['num'] ?? 0
);


$pages = $pager->showPager($pagerTemplate, $pagerItemTemplate,$pagerItemTemplateActive,$requests->server("REQUEST_URI"), $queryString);

$currentNum = $pager->currentNum();

$products = $db->query("SELECT * FROM products LIMIT $pager->limit OFFSET $currentNum");

$images = $db->query("SELECT * FROM productImages WHERE product_id IN (".implode(",", array_column($products, 'id')).")");


for ($i = 0; $i < $pager->countPages(); $i++) {
    $pageNum = $i * $pager->limit;
    if ($pageNum != $pager->limitNum()) {
        foreach ($products as $key => $product){
            $userId = $product['user_id'];
            $user = $db->query("SELECT email FROM users WHERE id = ?", $product['user_id']);
            $item = new RenderPage($listItem);
            $smallImgs = '';
            foreach ($images as $key => $image){
                   if($product['id'] == $image['product_id']){
                       $defaultImgLink = $image['user_id'] . "_" . $image['product_id'] . "_" . $image['hash_id'];
                       $smallImgLink = $image['user_id'] . "_" . $image['product_id'] . "_" . "SMALL" . "_" . $image['hash_id'];

                       if (!isset($imgitem)) {
                           $imgitem = new RenderPage($imgLayout);
                           $imgitem->setContent('link', "assets/processedProductImg/" . $defaultImgLink)
                               ->setContent('image', "assets/processedProductImg/" . $defaultImgLink);
                       }

                       $smallImg = new RenderPage($smallItem);

                           $smallImg->setContent('link', "assets/processedProductImg/" . $defaultImgLink)
                               ->setContent('image', "assets/processedProductImg/" . $smallImgLink);
                           $smallImgs .= $smallImg->render();
                   }
            }

            $img = $imgitem->setContent('smallImages', $smallImgs)->render();

                unset($imgitem);

                $item->setContent('images', $img);

            $item
                ->setContent('name', ucfirst($product['name']))
                ->setContent('user', $user[0]['email'])
                ->setContent('price', $product['price'])
                ->setContent('description', $product['description']);
            $items.= $item->render();
        }
    }
    break;
}



$list->setContent('product', $items)
    ->setContent('pager', $pages)
    ->setContent('num', $pager->getCurrentPage());

echo $list->render();