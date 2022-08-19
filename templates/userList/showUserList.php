<?php
include "admin.php";
if($_REQUEST['current_list'])
{
//    include "templates/header.php";
    foreach(getUserData() as $user) {
        include "templates/userList/item.php";
    }
//    include "templates/footer.php";
}

if($_REQUEST['descending_sort'])
{
    foreach(sortDescending() as $user){
        include "templates/userList/item.php";
    }
}

if($_REQUEST['ascending_sort'])
{
    foreach(sortAscending() as $user){
        include "templates/userList/item.php";
    }
}

include "templates/userList/sortButtons.php";