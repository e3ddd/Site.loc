<?php

//if(isset($_POST['user'])){
//    $name = $_POST['name'];
//    $city = $_POST['city'];
//
//    $user = [
//        "name" => $name,
//        "city" => $city
//    ];

//    $json = json_encode(array('user' => $user));
foreach ($_POST as $key => $item){
    file_put_contents('test.json', $key . PHP_EOL,FILE_APPEND);
    break;
}
//}





