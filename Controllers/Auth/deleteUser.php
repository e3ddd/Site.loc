<?php
include getRealPath("requestClass.php");
include getRealPath("data/dataBase.php");

$requests = Request::getInstance();
$requests->setOrder('PGC');

$db = new DataBase('site.loc', 'dev','dev','dev');

$db->delete('users', $requests->num);