<?php

include "View/viewClass.php";
$layoutReg = file_get_contents("templates/RegAndSearch/regLayout.php");
$test = new RenderPage($layoutReg);


var_dump($test);