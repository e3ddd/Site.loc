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

$productViewCountSum = $db->query("SELECT SUM(count) as sum,hour,date FROM viewCounter WHERE product_id = ? GROUP BY hour,date", $prodId);
$data = [];
foreach ($productViewCountSum as $item) {
    if(!isset($data[$item['date']])) {
        $data[$item['date']] = array_fill(1, 24, 0);
    }
    $data[$item['date']][$item['hour']] = $item['sum'];
}

$viewDate = $db->query("SELECT DISTINCT date FROM viewCounter WHERE product_id = ?", $prodId);
$viewHour = $db->query("SELECT DISTINCT hour FROM viewCounter WHERE product_id = ?", $prodId);

$statisticLayout = file_get_contents('templates/ProductStatisticTable/productStatisticLayout.php');
$tableLayout = file_get_contents('templates/ProductStatisticTable/tableLayout.php');
$statisticHours = file_get_contents('templates/ProductStatisticTable/hours.php');
$statisticNumbers = file_get_contents('templates/ProductStatisticTable/numbers.php');
$statisticRow = file_get_contents('templates/ProductStatisticTable/row.php');

$statisticTable = new RenderPage($statisticLayout);
$statisticTableLayout = new RenderPage($tableLayout);
$hour = "";
$views = "";
$rows = "";
$hours = [];


for ($i=1;$i<25;$i++){
    $hours[] = $i;
}


foreach ($hours as $key => $num){
    $statisticHour = new RenderPage($statisticHours);
    $hour .= $statisticHour->setContent('hour', $num . ":00")->render();
}

foreach ($data as $date => $value){
$statisticRows = new RenderPage($statisticRow);
$statisticRows->setContent('date', $date);
foreach ($hours as $item){
    $statisticViews = new RenderPage($statisticNumbers);
    if($value[$item] !== 0){
        $views .= $statisticViews->setContent('number', $value[$item])->render();
    }else{
        $views .= $statisticViews->setContent('number', 0)->render();
    }
}
    $statisticRows->setContent('numbers', $views);
    unset($views);

    $rows .= $statisticRows->render();
}


$statisticTableLayout->setContent('hours', $hour)
    ->setContent('statisticRow', $rows);
$table = $statisticTableLayout->render();



$statisticTable->setContent('table', $table)
    ->setContent('title', 'Statistic');
echo $statisticTable->render();






