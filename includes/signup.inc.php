<?php
$action = $_POST["action"];
if($_SERVER["REQUEST_METHOD"] === "POST" && $action === "signup") {
    // collecting data
    $username = htmlspecialchars($_POST["username"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    $verifypassword = htmlspecialchars($_POST["confirm-password"]);

    // check valid input
    if(empty($username) || empty($email) || empty($password) || empty($verifypassword)) {
        header("Location: ../signup.php?Error=InvalidInput");
        exit();
    }

    // vaild email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?Error=InvalidEmail&username=".$username);
        exit();
    }

    // check if password and confirm password are the same 
    if($password !== $verifypassword) {
        header("Location: ../signup.php?Error=PasswordMismatch&username=" . $username . "&email=" . $email);
        exit();
    }

    // hashing password
    $option = ['cost' => 12,];
    $hashpassword = password_hash($password, PASSWORD_BCRYPT, $option);


    // if the email alreaddy exist or not 
    try {
        require "email.inc.php";
        require_once "dbh.inc.php";

        // Check if the username or email already exists
        $checkQuery = "SELECT COUNT(*) FROM users WHERE username=:username OR email=:email;";
        $smts = $pdo->prepare($checkQuery);
        $smts->bindParam(":username", $username);
        $smts->bindParam(":email", $email);
        $smts->execute();

        // fetching the count 
        $count = $smts->fetchColumn();



        // If the user already exists
        if($count > 0) {
            header("Location: ../signup.php?Error=AlreadyExists&".$username."&".$email);
            exit();
        }


        // insert new user into database
        $insertQuery = "INSERT INTO users(username, email, pwd) VALUES (:username, :email, :pwd);";
        $smts = $pdo->prepare($insertQuery);
        $smts->bindParam(":username", $username);
        $smts->bindParam(":email", $email);
        $smts->bindParam(":pwd", $hashpassword);
        $smts->execute();

        // close connection
        $pdo = null;
        $smts = null;


        // sending email
        $emailSending = new Email($email);
        $emailSending->emailSend();

        //Redirect to login page after successfull registration
        header("Location: ../login.php");
        
    } catch (PDOException $e){
        die("Query failed: " . $e->getMessage());
    }

} else {
    header("Location: ../index.php?Error=InvalidServer");
    exit();
}
