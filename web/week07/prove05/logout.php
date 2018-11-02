<?php
session_start();
session_destroy();

include('includes/header.php');
include('includes/navbar.php'); 
?>
<html>
<body>
<main>
    <h1>You've been signed out.</h1>
    <a href="login.php">LogIn</a>
</main>
</body></html>

<?php 
  include('includes/footer.php');
?>