<?php
include "View/viewClass.php";

$layoutLog = file_get_contents("templates/UserPersonalArea/logInLayout.php");
$logForm = file_get_contents("templates/UserPersonalArea/logInForm.php");
$title = "Login Form";

$form = new RenderPage($layoutLog);

$form->setContent('title', $title)
    ->setContent('registration', $logForm);
echo $form ->render();