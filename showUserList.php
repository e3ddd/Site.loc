<?php
include "admin.php";
if($_REQUEST['current_list'])
{
    for($i=0;$i<=count(getUserData()['email']);$i++)
    {
   include "templates/userList.php";
   $email = getUserData()['email'][$i];
   $pass = getUserData()['password'][$i];
    }
}

if($_REQUEST['descending_sort'])
{
    for($i=0;$i<count(sortDescending()['email']);$i++)
    {
        include "templates/userList.php";
        $email = sortDescending()['email'][$i];
        $pass = sortDescending()['password'][$i];
    }
}

if($_REQUEST['ascending_sort'])
{
    for($i=0;$i<=count(sortAscending()['email']);$i++)
    {
        include "templates/userList.php";
        $email = sortAscending()['email'][$i];
        $pass = sortAscending()['password'][$i];
    }
}

include "templates/sortButtons.php";