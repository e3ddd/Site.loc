<?php

include 'data/dataBase.php';
$test = new DataBase('site.loc', 'dev','dev','dev');

//var_dump($query = $test->selectAll("users"));

//$select = $test->db_operation("SELECT DISTINCT email FROM users WHERE email LIKE 'a%'");
//
//$email = [];
//
//for ($i=0;$i<$select->num_rows;$i++){
//    $email[$i] = $select->fetch_assoc();
//}

var_dump($test->db_query("SELECT * FROM users
       WHERE EXISTS(SELECT 'email' FROM users WHERE email = 'zakazaka02@gmail.com')
       "));