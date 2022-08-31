<?php
include getRealPath("scripts/FileOperations/CSVFileOperations.php");

function submitEmptyCheck($email, $password): bool
{
    $result = true;
    if(empty($email) || empty($password)){
        echo "Email or password not entered !";
        $result = false;
    }
    return $result;
}

function regUser($email, $password)
{
        if(submitEmptyCheck($email, $password)){
            if(userExists($email) === false){
                putToFile($email, $password);
            }else{
                return "Your e-mail exist !";
            }
        }
}

function searchUser($email)
{
    foreach (getUserData() as $user){
        if ($email == $user["email"])
        {
            return $user;
        }
    }
}