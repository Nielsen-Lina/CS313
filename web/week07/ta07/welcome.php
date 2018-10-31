<?php
session_start();
$loggedIn = false;
if (!empty($_SESSION['username'])) {
    $loggedIn = true;
}
else {
    header("Location: signin.php");
}
?>
<html>
<body>
    <?php if ($loggedIn) : ?>
    <h1>Welcome: <?php echo $_SESSION['username']; ?></h1>
    <h2>You've signed in.</h2>
    <a href="logout.php">Logout</a>
    <?php endif; ?>
</body></html>