<?php
include getRealPath("requestClass.php");
include getRealPath("FileOperations.php");

$requests = Request::getInstance();

$requests->setOrder('GCP');

$regUser = new FileOperations("a+",
    $user = [$requests->email, $requests->password]);

$getUsersData = new FileOperations("r",
    $userID = ['email', 'password']);

if(empty($requests->email) || empty($requests->password)){
    echo "Email or password not entered !";
    }else{
      if($getUsersData->existItem($requests->email, 'email', getRealPath("data/users.csv"))){
          echo "Your e-mail exist !";
      }else{
          $regUser->putToFile(getRealPath("data/users.csv"), $user);
      }
    }


