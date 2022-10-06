<?php
$data = file_get_contents('https://neon.ua/catalog/kabel_razyomi/');
$doc = new DOMDocument();
$doc->loadHTML($data);

//$item = $doc->getElementsByTagName('div');

//for ($i=0;$i<$item->length;$i++){
//    foreach ($item->item($i)->childNodes as $value){
//        if($item[$i]->getAttribute('class') == "itemCells"){
//            echo $value->textConte  nt;
//        }
//    }
//}


//foreach ($item as $element)
//{
//    if ($element->getAttribute('class') == "itemCells")
//    {
//        $element = explode("код:", $element->nodeValue);
//
//        foreach ($element as $item){
//          echo $item . "<br>";
//        }
//    }
//}


$xpath = new DOMXPath($doc);

$item = $xpath->query("//div[@id = 'itemsBlock']/div[@class = 'item']/div[@class = 'title']/a");
$price = $xpath->query("//div[@id = 'itemsBlock']/div[@class = 'item']/div[@class = 'price']//span[@class = 'zi']");
$products = [];
for ($i=0;$i<$item->length;$i++){
     $products[] = [
         'title' => $item->item($i)->textContent,
             'price' => $price->item($i)->textContent
     ];
//    $item->item($i)->textContent
//   $price->item($i)->textContent
}











