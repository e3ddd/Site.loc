<?php
include getRealPath("View/viewClass.php");
include getRealPath("requestClass.php");
include getRealPath("data/dataBase.php");

$servername = "site.loc";
$username = "dev";
$password = "dev";
$dbname = "dev";


$db = new DataBase("mysql:host=$servername;dbname=$dbname", $username, $password);

$requests = Request::getInstance();
$requests->setOrder('PGC');

    $db->query("DELETE FROM products WHERE id = ?", $requests->num);

