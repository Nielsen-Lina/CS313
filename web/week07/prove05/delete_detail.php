<?php

session_start();

if (!empty($_SESSION['username']) && !empty($_SESSION['password']))
{
    require("dbConnect.php");
    $db = get_db();
}
else
{
    header("Location: login.php");
    die();
}

$company_chk = !empty($_POST['company_chk']) ? $_POST['company_chk'] : [];

foreach ($company_chk as $company)
{
  $stmt = $db->prepare('DELETE FROM detail WHERE detail_id=:detail_id');
  $stmt->bindValue(':detail_id', (int)$company);
  $stmt->execute();
}

$new_page = "change.php";
header("Location: $new_page");
die();

?>