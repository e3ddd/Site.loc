<?php
include getRealPath("View/viewClass.php");
include getRealPath("requestClass.php");
include getRealPath("data/dataBase.php");

$db = new DataBase('site.loc', 'dev', 'dev', 'dev');


$requests = Request::getInstance();
$requests->setOrder('PGC');

$db = new DataBase('site.loc', 'dev','dev','dev');

$db->delete('products', $requests->num);