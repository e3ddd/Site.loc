<?php
include "View/viewClass.php";

$layoutReg = file_get_contents("templates/RegAndSearch/regLayout.php");
$regForm = file_get_contents("templates/RegAndSearch/regForm.php");
$searchForm = file_get_contents("templates/RegAndSearch/searchForm.php");
$title = "Registration And Search Forms";

$form = new RenderPage($layoutReg);

$form->setContent('title', $title)
    ->setContent('registration', $regForm)
    ->setContent('search', $searchForm);

echo $form ->render();
