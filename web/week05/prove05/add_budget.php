<?php

require("dbConnect.php");
$db = get_db();

$category_name = htmlspecialchars($_POST['category_name']);
$amount = htmlspecialchars($_POST['amount']);

if (!isset($category_name) || trim($category_name) == '')
{
  include('error.php');
}
else
{
  $res = $db->query('SELECT count(*) FROM budget');
  $category_id = $res->fetchColumn();

  (int)($category_id += 1);

  $stmt = $db->prepare('INSERT INTO budget(category_id, category_name, amount) 
  	VALUES (:category_id, :category_name, :amount)');
  $stmt->bindValue(':category_id', $category_id, PDO::PARAM_INT);
  $stmt->bindValue(':category_name', ucfirst($category_name), PDO::PARAM_STR);
  $stmt->bindValue(':amount', $amount, PDO::PARAM_INT);
  $stmt->execute();

  $new_page = "change.php";
  header("Location: $new_page");
  die();
}

?>