<?php

// first createa dsn and db_username and $db_password
$dsn = "mysql:host=localhost;dbname=myUserDatabase";
$dbusername = "root";
$dbpassword = "";


// create php databse object
try {
    $pdo = new PDO($dsn, $dbusername, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}