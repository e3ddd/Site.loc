<?php
include getRealPath("requestClass.php");
include getRealPath("FileOperations.php");

$requests = Request::getInstance();

$requests->setOrder('GCP');

$num = mt_rand(1,999);

$regUser = new FileOperations("a+",
    $user = [$num, $requests->email, $requests->password]);

if($num === $regUser->getFileData("data/users.csv")['num']){
    $num = mt_rand(1,999);
}

$getUsersData = new FileOperations("r",
    $userID = ['num', 'email', 'password']);

if(empty($requests->email) || empty($requests->password)){
    echo "Email or password not entered !";
    }else{
      if($getUsersData->existItem($requests->email, 'email', getRealPath("data/users.csv"))){
          echo "Your e-mail exist !";
      }else{
          $regUser->putToFile(getRealPath("data/users.csv"), $user);
      }
    }


