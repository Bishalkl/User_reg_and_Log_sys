<?php
$action = $_POST["action"];
if ($_SERVER["REQUEST_METHOD"] === "POST" && $action === "signup") {
    // Collecting data
    $username = htmlspecialchars($_POST["username"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    $verifypassword = htmlspecialchars($_POST["confirm-password"]);

    // Check valid input
    if (empty($username) || empty($email) || empty($password) || empty($verifypassword)) {
        header("Location: ../signup.php?Error=InvalidInput");
        exit();
    }

    // Valid email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?Error=InvalidEmail&username=" . $username);
        exit();
    }

    // Check if password and confirm password are the same 
    if ($password !== $verifypassword) {
        header("Location: ../signup.php?Error=PasswordMismatch&username=" . $username . "&email=" . $email);
        exit();
    }

    // Hash password
    $option = ['cost' => 12];
    $hashpassword = password_hash($password, PASSWORD_BCRYPT, $option);

    // If the email already exists or not
    try {
        require_once "dbh.inc.php"; // Database connection file

        // Check if the username or email already exists
        $checkQuery = "SELECT COUNT(*) FROM users WHERE username=:username OR email=:email;";
        $smts = $pdo->prepare($checkQuery);
        $smts->bindParam(":username", $username);
        $smts->bindParam(":email", $email);
        $smts->execute();

        // Fetching the count 
        $count = $smts->fetchColumn();

        // If the user already exists
        if ($count > 0) {
            header("Location: ../signup.php?Error=AlreadyExists&" . $username . "&" . $email);
            exit();
        }

        // Insert new user into the database
        $insertQuery = "INSERT INTO users(username, email, pwd) VALUES (:username, :email, :pwd);";
        $smts = $pdo->prepare($insertQuery);
        $smts->bindParam(":username", $username);
        $smts->bindParam(":email", $email);
        $smts->bindParam(":pwd", $hashpassword);
        $smts->execute();

        // Close connection
        $pdo = null;
        $smts = null;

        // Redirect to login page after successful registration
        header("Location: ../login.php");
        exit();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

} else {
    header("Location: ../index.php?Error=InvalidServer");
    exit();
}
