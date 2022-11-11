<?php
include "../View/viewClass.php";

$formPageLayout = file_get_contents("templates/formLayout.php");
$container_1_layout = file_get_contents("templates/container_1.php");
$container_2_layout = file_get_contents("templates/container_2.php");

$form = new RenderPage($formPageLayout);


$form
    ->setContent("container1", $container_1_layout)
    ->setContent("container2",$container_2_layout);

echo $form->render();