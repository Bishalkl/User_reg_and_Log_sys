<?php

// first create a dsn and db_username and db_password
$dsn = "mysql:host=localhost;dbname=myUserDatabase";
$dbusername = "root";
$dbpassword = ""; // Corrected variable name

// create PHP database object
try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword); // Corrected variable name
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
