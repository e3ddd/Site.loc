<?php
function userExists($email)
{
    if(($file = fopen("data/users.csv", "r")) !== false)
    {
        $result = false;
        while(($data = fgetcsv($file, 1000, ",")) !== false)
        {
            if ($email == $data[0])
            {
                $result = true;
            }
        }
        fclose($file);
            return $result;
    }
}

function putUserToFile($email, $pass)
{
    $result = false;
    if(!empty($email) && !empty($pass))
    {
        $user = [$email, $pass];
        $file = fopen("data/users.csv", "a+");
        fputcsv($file, $user);
        fclose($file);
        $result = true;
    }
    else
    {
        return $result;
    }
}

function regUser($email, $pass)
{
    if(!userExists($_POST['email']))
    {
        if(putUserToFile($_POST['email'], $_POST['password']) === false)
        {
            echo "Fields must not be empty!";
        }
    }
    else
    {
        echo "Your E-mail exist !";
    }
}

function searchUser($email)
{
    if(($file = fopen("data/users.csv", "r")) !== false)
    {
        while(($data = fgetcsv($file, 1000, ",")) !== false)
        {
            if ($email == $data[0])
            {
                return $data;
            }
        }
        fclose($file);
        return true;
    }
}



if($_REQUEST["submitReg"])
{
    regUser($_POST['email'], $_POST['password']);
}

if($_REQUEST['search'])
{
    foreach (searchUser($_POST['email']) as $item)
    {
        echo $item . "<br>";
    }
}