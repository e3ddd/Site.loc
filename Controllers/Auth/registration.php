<?php
include getRealPath("scripts/RegAndSearchScripts/form.php");
include getRealPath("requestClass.php");

$requests = Request::getInstance();

$requests->setOrder('GCP');

echo regUser($requests->email, $requests->password);