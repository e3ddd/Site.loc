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



$xml = new DOMDocument();
$xml->formatOutput = true;
$main = $xml->createElement('products');
$body = "";
$productXML = '<?xml version="1.0" encoding="UTF-8" ?>';
$productXML .= "<". $main->tagName . ">";
foreach ($products as $product){
    $item = $xml->createElement('product');
    $name = $xml->createElement('name', $product['title']);
    $price = $xml->createElement('price', $product['price']);
    $item->appendChild($name);
    $item->appendChild($price);
    $productXML .= "<". $item->tagName . ">"
        . "<". $name->tagName . ">" . $name->textContent . "</". $name->tagName . ">"
        . "<". $price->tagName . ">" . $price->textContent . "</". $price->tagName . ">"
        . "</". $item->tagName . ">";
}

$productXML .= "</". $main->tagName . ">";


$xml->loadXML($productXML);
$path = 'test.xml';
echo $xml->save($path);

$xmlFile = new SimpleXMLElement($productXML);

echo "<pre>"; print_r($xmlFile);







//
//echo "<pre>"; print_r("&lt". $main->localName . "&gt");
//echo "<pre>"; echo "   "; print_r("&lt". $item->localName . "&gt");
//echo "<pre>"; echo "    "; echo "&lt". "name" . "&gt"; print_r($name->textContent);echo "&lt/". "name" . "&gt";
//echo "<pre>"; echo "    "; echo "&lt". "price" . "&gt"; print_r($price->textContent);echo "&lt/". "price" . "&gt";
//echo "<pre>"; echo "   "; print_r("&lt/". $item->localName . "&gt");
//echo "<pre>"; print_r("&lt/". $main->localName . "&gt");
