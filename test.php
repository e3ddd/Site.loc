<?php

$servername = "site.loc";
$username = "dev";
$password = "dev";
$dbname = "dev";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO users (id, email, password)
  VALUES (:id, :email, :password)");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);

    // insert a row
    $id = 0;
    $email = "john@example.com";
    $password = "123";
    $stmt->execute();


    echo "New records created successfully";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}