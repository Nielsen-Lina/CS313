<?php
session_start();
require_once "db.php";
$db = openDBConnection();
$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
if (!empty($username) && !empty($password)) {
    unset($_SESSION['username']);
    $statement = "SELECT password from UsersTest WHERE username = :username";
    $preparedStatement = $db->prepare($statement);
    $preparedStatement->execute([':username' => $username]);
    $row = $preparedStatement->fetch(PDO::FETCH_ASSOC);
    $checkPasswordHash = $row['password']; 
    
    if (password_verify($password, $checkPasswordHash)) {
        $_SESSION['username'] = $username;
        header("Location: welcome.php");
        die();
    }
}
?>
<html>
<body>
<style>
    input { display: inline-block; }
</style>
    <a href="signup.php">Signup</a>
    <form action="" method="post">
        <input type="text" name="username" id="username" placeholder="Username" />
        <input class="" type="password" name="password" id="password" placeholder="Password" />
        <input type="submit" value="Login">
    </form>
</body>