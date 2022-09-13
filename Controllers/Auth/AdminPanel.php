<?php
include getRealPath("View/viewClass.php");
include getRealPath("FileOperations.php");
include getRealPath("requestClass.php");
include getRealPath("Pager.php");


$layoutList = file_get_contents("templates/UserList/listLayout.php");
$listItem = file_get_contents("templates/UserList/listItem.php");
$deleteBut = file_get_contents("templates/UserList/deleteBut.php");
$editBut = file_get_contents("templates/UserList/editBut.php");
$productBut = file_get_contents("templates/ProductsList/productBut.php");
$pagerItemTemplate = file_get_contents("templates/UserList/pagerItem.php");
$pagerItemTemplateActive = file_get_contents("templates/UserList/pagerActiveItem.php");
$pagerTemplate = file_get_contents("templates/UserList/pager.php");
$searchField = file_get_contents("templates/UserList/searchField.php");
$homeLink = "index.php?page=Auth/AdminPanel";
$title = "Admin Panel";

$requests = Request::getInstance();
$requests->setOrder('PGC');

$list = new RenderPage($layoutList);
$users = new FileOperations("r", $user = ["email", "password"]);

$user = $users->getFileData(getRealPath("data/users.csv"));

$items = "";

$URL = parse_url($_SERVER['REQUEST_URI']);

parse_str($URL['query'] , $queryString);

$pages = [];

$searchEmail = [];

if(!empty($requests->search)){
    foreach ($user as $key => $email){
        if(strncasecmp($email['email'], $requests->search, strlen($requests->search)) == 0){
            $searchEmail[] = [
                'email' => $email['email'],
                'password' => $email['password']
                ];
        }
    }
}

if(empty($requests->search)) {
    $pager = new Pager(
        count($users->getFileData(getRealPath("data/users.csv"))),
        10,
        (int)$queryString['num'] ?? 0
    );
}else{
    $pager = new Pager(
        count($searchEmail),
        10  ,
        (int)$queryString['num'] ?? 0
    );
    $user = $searchEmail;
}

    if ($pager->hasPrevPage()) {
        $pages[] = (new RenderPage($pagerItemTemplate))
            ->setContent('URL', $pager->generateURL($requests->server("REQUEST_URI"), $queryString['num'] - 1))
            ->setContent('TITLE', 'Prev')
            ->render();
    }

    for ($i = 0; $i < $pager->countPages(); $i++) {
        if ($pager->activeItem($i)) {
            $pages[] = (new RenderPage($pagerItemTemplateActive))
                ->setContent('URL',  $pager->generateURL($requests->server("REQUEST_URI"), $i))
                ->setContent('TITLE', $i + 1)
                ->render();
        } else {
            $pages[] = (new RenderPage($pagerItemTemplate))
                ->setContent('URL',  $pager->generateURL($requests->server("REQUEST_URI"), $i))
                ->setContent('TITLE', $i + 1)
                ->render();
        }
    }

    if ($pager->hasNextPage()) {
        $pages[] = (new RenderPage($pagerItemTemplate))
            ->setContent('URL',  $pager->generateURL($requests->server("REQUEST_URI"),$queryString['num'] + 1))
            ->setContent('TITLE', 'Next')
            ->render();
    }


$search = (new RenderPage($searchField))
    ->setContent('items', $searchField)
    ->render();


$pages = (new RenderPage($pagerTemplate))
    ->setContent(
        'items',
        implode('', $pages)
    )
    ->render();

$products = new FileOperations('r', ["email", "products"]);
$productList = $products->getFileData("data/products.csv");

//$productsTmp = "";
//foreach ($products->getFileData("data/products.csv") as $item){
//    if($requests->email === $item['email']){
//        $productsTmp = $item['products'];
//    }
//}

for ($i = 0; $i < $pager->countPages(); $i++) {
        $pageNum = $i * $pager->limit;
        if ($pageNum != $pager->limitNum()) {
            for ($j = $pager->currentNum(); $j < $pager->limitNum(); $j++) {
                $edit = (new RenderPage($editBut))
                    ->setContent("email", $user[$j]['email'])
                    ->setContent("password", $user[$j]['password'])
                    ->render();
                $delete = (new RenderPage($deleteBut))
                    ->setContent("email", $user[$j]['email'])
                    ->render();
                $tmp = "";
              foreach ($productList as $item){
                  if($item['email'] == $requests->email){
                      $tmp = $item['products'];
                      break;
                  }
              }

              $product = (new RenderPage($productBut))
                  ->setContent("email", $user[$j]['email'])
                  ->setContent("product", $tmp)
                  ->render();
                unset($tmp);

                $item = new RenderPage($listItem);
                $item->setContent('email', $user[$j]['email'])
                    ->setContent('password', $user[$j]['password'])
                    ->setContent('edit', $edit)
                    ->setContent('delete', $delete)
                    ->setContent('product', $product);
                $items .= $item->render();
                if ($j == $pager->amountDataItems - 1) {
                    break;
                }
            }
        }
        break;
    }


$list->setContent('title', $title)
    ->setContent('search', $search)
    ->setContent('list', $items)
    ->setContent('pager', $pages)
    ->setContent('home' , $homeLink)
    ->setContent('num', $pager->getCurrentPage());

echo $list->render();
var_dump($_REQUEST);