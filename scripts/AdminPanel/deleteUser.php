<?php
include_once getRealPath("scripts/FileOperations/CSVFileOperations.php");

function deleteUser($email): bool
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
function delete($email)
{
    if(deleteUser($email)){
        if(copy(getRealPath("data/newUsers.csv"), getRealPath("data/users.csv"))){
            unlink(getRealPath("data/newUsers.csv"));
        }
    }
}