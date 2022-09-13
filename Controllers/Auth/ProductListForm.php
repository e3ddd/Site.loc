<?php
include "View/viewClass.php";

$layoutProd = file_get_contents("templates/ProductsList/productFormLayout.php");
$productForm = file_get_contents("templates/ProductsList/addProductForm.php");
$title = "Add product";

$form = new RenderPage($layoutProd);

$form->setContent('title', $title)
    ->setContent('product', $productForm);

echo $form ->render();