<?php
include "admin.php";
foreach (getUserData() as $user)
{
    include "templates/userList/listItem.php";
}

