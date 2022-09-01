<?php

function openFile(bool $read = true)
{
    $file = fopen(getRealPath("data/users.csv"), $read ? "r" : "a+");
    if(!$file){
        throw new RuntimeException('Can\'t open file');
    }
    return $file;
}

function openNewFile(bool $read = true){
    $file = fopen(getRealPath("data/newUsers.csv"), $read ? "r" : "a+");
    if(!$file){
        throw new RuntimeException('Can\'t open file');
    }
    return $file;
}

function putToFile($email, $password): bool
{
    $file = openFile(false);
    $user = [$email, $password];
    fputcsv($file, $user);
    fclose($file);
    return true;
}

function getUserData(): array
{
    $user = [];
    $file = openFile(false);
    while(($data = fgetcsv($file, 1000, ",")) !== false){
        $user[] = [
            "email" => $data[0],
            "password" => $data[1]
        ];
    }
    fclose($file);
    return $user;
}

function userExists($email): bool
{
    $result = false;
    foreach (getUserData() as $user){
        if($email == $user["email"]){
            $result = true;
            break;
        }
    }
    return $result;
}