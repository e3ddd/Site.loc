<?php
include getRealPath("View/viewClass.php");
include getRealPath("requestClass.php");
include getRealPath("FileOperations.php");

$editItem = file_get_contents("templates/UserList/editItem.php");

$requests = Request::getInstance();

$requests->setOrder('PGC');

$userPassword = new FileOperations('r', ['num','email','password']);
$users = $userPassword->getFileData("data/users.csv");
$password = "";

foreach ($users as $user){
    if($requests->email === $user['email']){
        $password = $user['password'];
    }
}

$newUser = new RenderPage($editItem);
$newUser->setContent('content', $requests->email)
    ->setContent('additional', $password)
    ->setContent('num', $requests->num)
    ->setContent('email', $requests->email)
    ->setContent('method', 'POST')
    ->setContent('action', "index.php?page=Auth/editUser");
echo $newUser->render();


if($requests->action == "Ok"){;
    $product = new EditOperations('a+',['num', 'email', 'product', 'price', 'description']);
    $productItem = [];
    $productItem[] = $product->getFileData("data/products.csv");

    if($requests->action == "Ok"){
        $user = new FileOperations('a+', $user = ['num', 'email', 'password']);
        if(!$user->existItem($requests->content, 'email', getRealPath("data/users.csv"))){
            $file = $user->openFile('data/newUsers.csv');
            fclose($file);
            $productFile = $product->openFile('data/newProducts.csv');
            fclose($productFile);
            if($user->deleteFileDataItem(getRealPath('data/users.csv'), getRealPath("data/newUsers.csv"), $requests->userNum, 'num')){
                $user->putToFile(getRealPath("data/users.csv"), [$requests->userNum, $requests->content, $requests->additional]);
            if($product->deleteFileDataItem(getRealPath('data/products.csv'), getRealPath("data/newProducts.csv"), $requests->userEmail, 'email'))
                foreach ($productItem as $item){
                    foreach ($item as $value){
                        if($value['email'] === $requests->userEmail){
                         $product->putToFile("data/products.csv", [$value['num'], $requests->content, $value['product'], $value['price'], $value['description']]);
                         }
                    }
                }
            }
        }else{
            echo "E-mail exist !";
        }
    }
}



