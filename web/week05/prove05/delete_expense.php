<?php

require("dbConnect.php");
$db = get_db();

$expense_chk = !empty($_POST['expense_chk']) ? $_POST['expense_chk'] : [];

foreach ($expense_chk as $expense)
{
  $stmt = $db->prepare('DELETE FROM expense WHERE expense_id=:expense_id');
  $stmt->bindValue(':expense_id', (int)$expense);
  $stmt->execute();
}

$new_page = "change.php";
header("Location: $new_page");
die();

?>