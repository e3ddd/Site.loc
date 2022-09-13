<?php
include getRealPath("View/viewClass.php");
include getRealPath("requestClass.php");
include getRealPath("FileOperations.php");

$editItem = file_get_contents("templates/UserList/editItem.php");
$productListItem = file_get_contents("templates/ProductsList/productListItem.php");
$products = file_get_contents("templates/ProductsList/productItem.php");

$requests = Request::getInstance();

$requests->setOrder('PGC');
$user = new EditOperations('a+', $user = ['email', 'password']);

$user->deleteFileDataItem(getRealPath('data/users.csv'), getRealPath("data/newUsers.csv"), $requests->email);