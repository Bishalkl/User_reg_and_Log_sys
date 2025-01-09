<?php
session_start();
$action = $_POST["action"];
if($_SERVER["REQUEST_METHOD"] === "POST" && $action === "login") {
    // collecting data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // hashing password
    $option = [
        'cost' => 12,
    ];
    
    // hashpassword
    $hashpassword = password_hash($password, PASSWORD_BCRYPT, $option);

    // check all the value is input or not
    if(empty($email) || empty($password)) {
        header("Location: ../login.php?Error=InvalidInput");
        exit();
    }

    // check the email is valident or not
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../login.php?Error=InvalidEmail");
        exit();
    }

    try {
        require_once("dbh.inc.php");
        // check if the username or email already exists
        $checkQuery = "SELECT * FROM users WHERE email=:email;";
        $stmt = $pdo->prepare($checkQuery);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        // fetch the user record
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // check if user exists and verify the password
        if($user && password_verify($password, $user['pwd'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: ../dashboard.php");
            exit();
        } else {
            header("Location: ../login.php?Error=InvalidCredentials");
            exit();
        }

    } catch (PDOException $e) {
        die("Query failed: ". $e->getMessage());
    }


} else {
    header("Location: ../index.php?Error=InvalidServer");
    exit();
}