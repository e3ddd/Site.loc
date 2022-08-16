<?php
function getUserData()
{
    if(($file = fopen("data/users.csv", "r")) !== false)
    {
        $users = [
            'email' => [],
            'password' => []
        ];
        while(($data = fgetcsv($file, 1000, ",")) !== false)
        {
         $users['email'][] = $data[0];
         $users['password'][] = $data[1];
        }
        return $users;
    }
}

function userNumber()
{
    $num = 0;
    $arr = [];
    if(($file = fopen("data/users.csv", "r")) !== false)
    {
        while(($data = fgetcsv($file, 1000, ",")) !== false)
        {
            $num++;
            $arr[] = $num;
        }
        return $arr;
    }
}

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

function edit($email, $pass, $userNum)
{
    $user = [$email, $pass];
    $num = 0;
    if (($file = fopen("data/users.csv", "r")) !== false)
    {
        $newFile = fopen("data/newUsers.csv", "a+");
        while (($data = fgetcsv($file, 1000, ",")) !== false)
        {
            $num++;
            if($num == $userNum)
            {
             continue;
            }
           fputcsv($newFile, $data);
        }
        fputcsv($newFile, $user);
        fclose($newFile);
        fclose($file);
        return true;
    }
}

function delete($email)
{
    if (($file = fopen("data/users.csv", "r")) !== false)
    {
        $newFile = fopen("data/newUsers.csv", "a+");
        while (($data = fgetcsv($file, 1000, ",")) !== false)
        {
            if($email === $data[0])
            {
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
    if(userExists($email) === true)
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

function sortAscending(): array
{
$users = [
    'email' => [],
    'password' => [],
    'num' => []
];

for($i=0;$i<=count(getUserData()['email']);$i++)
{
    $users['email'][$i] = getUserData()['email'][$i];
    $users['password'][$i] = getUserData()['password'][$i];
    $users['num'][$i] = userNumber()[$i];
}

sort($users['email']);
sort($users['password']);
sort($users['num']);

return $users;
}

function sortDescending(): array
{
    $users = [
        'email' => [],
        'password' => [],
        'num' => []
    ];

    for($i=0;$i<=count(getUserData()['email']);$i++)
    {
        $users['email'][$i] = getUserData()['email'][$i];
        $users['password'][$i] = getUserData()['password'][$i];
        $users['num'][$i] = userNumber()[$i];
    }

    rsort($users['email']);
    rsort($users['password']);
    rsort($users['num']);

    return $users;
}



if($_REQUEST['edit'])
{
   editUser($_POST['email'], $_POST['password'],  $_POST['num']);
}

if($_REQUEST['delete'])
{
    deleteUser($_POST['email']);
}





