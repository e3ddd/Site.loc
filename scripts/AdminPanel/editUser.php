<?php
include_once getRealPath("scripts/FileOperations/CSVFileOperations.php");

include getRealPath("templates/UserList/editItem.php");


function editField($email)
{
    foreach (getUserData() as $user) {
        if ($email == $user['email']) {
            return $user;
        }
    }
    return false;
}

function deleteEmail($email): bool
{
    $file = openNewFile(false);
    foreach(getUserData() as $user){
        if($email == $user['email']){
            continue;
        }else{
            fputcsv($file, $user);
        }
    }
    fclose($file);
    return true;
}

function putNewUser($user)
{
    $file = openNewFile(false);
    fputcsv($file, $user);
    fclose($file);
    return true;
}

function edit($user)
{
    if(putNewUser($user)){
        if(copy(getRealPath("data/newUsers.csv"), getRealPath("data/users.csv"))){
            unlink(getRealPath("data/newUsers.csv"));
        }
    }
}

