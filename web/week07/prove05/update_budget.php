<?php

require("dbConnect.php");
$db = get_db(); 

$category_name = htmlspecialchars($_POST['category_name']);
$amount = htmlspecialchars($_POST['amount']);

$new_page = "change.php";

$category_chk = !empty($_POST['category_chk']) ? $_POST['category_chk'] : [];

foreach ($category_chk as $category)
{
  /*
  $stmt = $db->prepare('UPDATE budget SET category_name=:category_name, amount=:amount WHERE category_id=:category_id');
  $stmt->bindValue(':category_id', (int)$category);
  $stmt->bindValue(':category_name', $category_name);
  $stmt->bindValue(':amount', $amount);
  $stmt->execute();
  */
  if (isset($_POST["update_category"]))
  {
    if (!isset($category_name) || trim($category_name) == '')
    {
      $new_page = "error.php";
    }
    else
    {
      $stmt = $db->prepare('UPDATE budget SET category_name=:category_name WHERE category_id=:category_id');
      $stmt->bindValue(':category_id', (int)$category);
      $stmt->bindValue(':category_name', ucfirst($category_name));
      $stmt->execute();
    }
  }
  elseif (isset($_POST["update_amount"]))
  {
    if (!isset($amount) || trim($amount) == '')
    {
      $new_page = "error.php";
    }
    else
    {
      $stmt = $db->prepare('UPDATE budget SET amount=:amount WHERE category_id=:category_id');
      $stmt->bindValue(':category_id', (int)$category);
      $stmt->bindValue(':amount', $amount);
      $stmt->execute();
    }
  }
  
}

header("Location: $new_page");
die();

?>