<?php

include getRealPath("requestClass.php");
include getRealPath("data/dataBase.php");
include getRealPath("View/viewClass.php");

$requests = Request::getInstance();
$requests->setOrder('PGC');
$prodId = $requests->prodId;

$servername = "site.loc";
$username = "dev";
$password = "dev";
$dbname = "dev";

$db = new DataBase("mysql:host=$servername;dbname=$dbname", $username, $password);

$productViewCountSum = $db->query("SELECT SUM(count) FROM viewCounter WHERE product_id = ? GROUP BY hour", $prodId);
$viewHours = $db->query("SELECT DISTINCT hour,date FROM viewCounter WHERE product_id = ?", $prodId);


$statisticLayout = file_get_contents('templates/ProductStatisticTable/productStatisticLayout.php');
$tableLayout = file_get_contents('templates/ProductStatisticTable/tableLayout.php');
$statisticHours = file_get_contents('templates/ProductStatisticTable/hours.php');
$statisticNumbers = file_get_contents('templates/ProductStatisticTable/numbers.php');
$statisticDate = file_get_contents('templates/ProductStatisticTable/date.php');

$statisticTable = new RenderPage($statisticLayout);
$statisticTableLayout = new RenderPage($tableLayout);
$statisticNum = new RenderPage($statisticNumbers);
$hour = "";
$nums = "";
$hours = [];

for ($i=1;$i<25;$i++){
    $hours[] = $i;
}



foreach ($hours as $key => $num){
    $statisticHour = new RenderPage($statisticHours);
    $hour .= $statisticHour->setContent('hour', $num)->render();
}



$statisticTableLayout->setContent('hours', $hour)
    ->setContent('numbers', $nums);
$table = $statisticTableLayout->render();



$statisticTable->setContent('table', $table);
echo $statisticTable->render();






