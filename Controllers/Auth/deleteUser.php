<?php
include getRealPath("requestClass.php");
include getRealPath("data/dataBase.php");

$requests = Request::getInstance();
$requests->setOrder('PGC');

$servername = "site.loc";
$username = "dev";
$password = "dev";
$dbname = "dev";

$db = new DataBase("mysql:host=$servername;dbname=$dbname", $username, $password);

$db->query("DELETE FROM users WHERE id = ?", $requests->num);