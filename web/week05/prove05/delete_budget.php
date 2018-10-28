<?php

require("dbConnect.php");
$db = get_db();

$category_chk = !empty($_POST['category_chk']) ? $_POST['category_chk'] : [];

foreach ($category_chk as $category)
{
  $stmt = $db->prepare('DELETE FROM budget WHERE category_id=:category_id');
  $stmt->bindValue(':category_id', (int)$category);
  $stmt->execute();
}

$new_page = "change.php";
header("Location: $new_page");
die();

?>