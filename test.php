<?php
$data = file_get_contents('https://neon.ua/catalog/kabel_razyomi/');


$doc = new DOMDocument('1.0', 'utf-8');
$doc->loadHTML($data);

$text = $doc->doc
foreach ($text as $item){
    var_dump($item);
}