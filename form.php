<?php
function getUsersFile(bool $read = true)
{
    $file = fopen("data/users.csv", $read ? "r" : "a+");
    if(!$file){
        throw new RuntimeException('Can\'t open file');
    }
    return $file;
}

function userExists($email)
{
    $file = getUsersFile();
    if($file)
    {
        $result = false;
        while(($data = fgetcsv($file, 1000, ",")) !== false)
        {
            if ($email === $data[0])
            {
                $result = true;
                break;
            }
        }
        fclose($file);
        return $result;
    }
}

function putUserToFile($email, $password)
{

    if(!empty($email) && !empty($password))
    {
        $user = [$email, $password];
        $file = getUsersFile(false);
        fputcsv($file, $user);
        fclose($file);
        return true;
    }
    else
    {
       return false;
    }
}

function regUser($email, $password)
{
    if(!userExists($email)) {
        if(!putUserToFile($email, $password)) {
             return "Fields must not be empty!";
            }
        }
        else {
             return  "Your E-mail exist !";
        }
}

function searchUser($email)
{
    $file = getUsersFile();
    if($file)
    {
        while(($data = fgetcsv($file, 1000, ",")) !== false)
        {
            if ($email == $data[0])
            {
                return $data;
            }
        }
        fclose($file);
    }
}



if($_REQUEST["submitReg"]) {
   echo  regUser($_POST['email'], $_POST['password']);
}

if($_REQUEST['search']) {
    foreach (searchUser($_POST['email']) as $item) {
        echo $item . "<br>";
    }
}