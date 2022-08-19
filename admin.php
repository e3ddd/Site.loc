<?php

function getUsersFile(bool $read = true)
{
    $file = fopen("data/users.csv", $read ? "r" : "a+");
    if(!$file){
        throw new RuntimeException('Can\'t open file');
    }
    return $file;
}

function getTemporaryFile()
{
    $file = fopen("data/newUsers.csv", "a+");
    if(!$file){
        throw new RuntimeException('Can\'t open file');
    }
    return $file;
}

function getUserData(): array
{
    $file = getUsersFile();
    $users = [];
    $idx = 0;
    while(($data = fgetcsv($file, 1000, ",")) !== false) {
        $users[] = [
            'email' => $data[0],
            'password' => $data[1],
            'id' => $idx++
        ];
    }
    return $users;
}

function userExists($email): bool
{
    $result = false;
     foreach (getUserData() as $user){
         if ($email == $user['email'])
         {
             $result = true;
             break;
         }
    }
    fclose(getUsersFile());
    return $result;
}

function edit($email, $pass, $userNum)
{
    $user = [$email, $pass];
    $file = getUsersFile();
    if($file){
        $newFile = getTemporaryFile();
        if($newFile){
            foreach(getUserData() as $users){
                var_dump($userNum);
                if($users['id'] == $userNum){
                    continue;
                }
                fputcsv($newFile, $users);
            }
        }
        fputcsv($newFile, $user);
        fclose($newFile);
        fclose($file);
        return true;
    }
}

function delete($email)
{
    $file = getUsersFile();
    if ($file) {
        $newFile = getTemporaryFile();
        while (($data = fgetcsv($file, 1000, ",")) !== false){
            if($email === $data[0]){
                continue;
            }
            fputcsv($newFile, $data);
        }
        fclose($newFile);
        fclose($file);
        return true;
    }
}


function editUser($email, $pass, $userNum)
{
    if(userExists($email))
    {
       return "E-mail exist !";
    }
    else
    {
        if(edit($email, $pass, $userNum) === true)
        {
            copy("data/newUsers.csv", "data/users.csv");
            unlink("data/newUsers.csv");
            return true;
        }
    }
}

function deleteUser($email)
{
    if(delete($email) === true)
    {
        copy("data/newUsers.csv", "data/users.csv");
        unlink("data/newUsers.csv");
        return true;
    }
}

function ascending($a, $b): int
{
    if ($a == $b) {
        return 0;
    }
    return ($a < $b) ? -1 : 1;
}

function descending($a, $b): int
{
    if ($a == $b) {
        return 0;
    }
    return ($a > $b) ? -1 : 1;
}

function sortAscending()
{
    $users = getUserData();
    uasort($users, 'ascending');
    return $users;
}

function sortDescending(): array
{
    $users = getUserData();
    uasort($users, 'descending');
    return $users;
}

if($_REQUEST['edit']) {
    editUser($_POST['email'], $_POST['password'],  $_POST['num']);
}

if($_REQUEST['delete']) {
    deleteUser($_POST['email']);
}







