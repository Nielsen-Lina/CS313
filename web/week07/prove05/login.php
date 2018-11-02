<?php
session_start();

include('includes/header.php');
include('includes/navbar.php'); 

$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

if ($username == 'new_user' && $password == 'new_pass')
{
    require("dbConnect.php");
    $db = get_db();
    $_SESSION['username'] = 'new_user';
    $_SESSION['password'] = 'new_pass';
    header("Location: index.php");
    die();
}
else
{
    echo "<h3>Username and Password do not match! Try again.</h3>";
}

/*
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
*/
?>
<html>
<body>
<style>
    input { display: inline-block; }
</style>
<main>
    <form action="" method="post">
        <input type="text" name="username" id="username" placeholder="Username" />
        <input class="" type="password" name="password" id="password" placeholder="Password" />
        <input type="submit" value="Login">
    </form>
</main>
</body>

<?php 
  include('includes/footer.php');
?>