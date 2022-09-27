<?php
include getRealPath("View/viewClass.php");
include getRealPath("requestClass.php");
include getRealPath("data/dataBase.php");

$editItem = file_get_contents("templates/UserList/editItem.php");

$requests = Request::getInstance();
$requests->setOrder('PGC');

$servername = "site.loc";
$username = "dev";
$password = "dev";
$dbname = "dev";


$db = new DataBase("mysql:host=$servername;dbname=$dbname", $username, $password);

$users = $db->query("SELECT * FROM users");
$password = "";
foreach ($users as $user) {
    if ($user['email'] === $requests->email) {
        $password = $user['password'];
    }
    $newUser = new RenderPage($editItem);
    $newUser->setContent('content', $requests->email)
        ->setContent('additional', $password)
        ->setContent('num', $requests->num)
        ->setContent('email', $requests->email)
        ->setContent('method', 'POST')
        ->setContent('action', "index.php?page=Auth/editUser");;
}
echo $newUser->render();

if ($requests->action == "Ok") {
        $email = $requests->content;
        $password = $requests->additional;
        $oldEmail = $requests->userEmail;
        foreach ($users as $user) {
            if ($user['email'] !== $requests->content) {
                $db->query("UPDATE users SET email = ?, password = ? WHERE email = ?", $email, $password, $oldEmail);
            }
        }
    }




