<?php
include getRealPath("View/viewClass.php");
include getRealPath("requestClass.php");
include getRealPath("FileOperations.php");

$editItem = file_get_contents("templates/UserList/editItem.php");
$listLayout = file_get_contents("templates/UserList/listLayout.php");
$product = file_get_contents("templates/UserList/productList.php");

$requests = Request::getInstance();

$requests->setOrder('PGC');

switch ($requests->action){

    case "Edit":
        $user = new EditOperations('a+', $user = ['email', 'password']);
        $newUser = new RenderPage($editItem);
        $newUser->setContent('email', $requests->email)
                 ->setContent('password', $requests->password)
                 ->setContent('oldEmail', $requests->email);
        echo $newUser->render();
        break;

    case "Delete":
        $user = new EditOperations('a+', $user = ['email', 'password']);
        $user->deleteFileDataItem(getRealPath('data/users.csv'), getRealPath("data/newUsers.csv"), $requests->email);
        break;

    case "Products":
        $product = (new RenderPage($product))
            ->setContent('email', $requests->email)
            ->setContent('product', $requests->product)
            ->render();

        $productList = (new RenderPage($listLayout))
            ->setContent('title', "Product List")
            ->setContent('list', $product);
            echo  $productList->render();
        break;

    case "Ok":
        $user = new EditOperations('a+', $user = ['email', 'password']);
        if(!$user->existItem($requests->email, 'email', getRealPath("data/users.csv"))){
            if($user->deleteFileDataItem(getRealPath('data/users.csv'), getRealPath("data/newUsers.csv"), $requests->oldEmail)){
                $user->putToFile(getRealPath("data/users.csv"), [$requests->email, $requests->password]);
            }
        }else{
            echo "E-mail exist !";
        }
        break;
}
