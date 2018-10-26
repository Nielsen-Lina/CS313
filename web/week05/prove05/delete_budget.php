<?php

try
{
  $dbUrl = getenv('DATABASE_URL');

  $dbOpts = parse_url($dbUrl);

  $dbHost = $dbOpts["host"];
  $dbPort = $dbOpts["port"];
  $dbUser = $dbOpts["user"];
  $dbPassword = $dbOpts["pass"];
  $dbName = ltrim($dbOpts["path"],'/');

  $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
} 

$category_name = htmlspecialchars($_POST['category_name']);
$amount = htmlspecialchars($_POST['amount']);

$category_chk = !empty($_POST['category_chk']) ? $_POST['category_chk'] : [];

foreach ($category_chk as $category)
{
  echo $category;

  $stmtTopics = $db->prepare('DELETE FROM budget WHERE category_name=$category');
  $stmtTopics->execute();
  /*
  $stmtTopics = $db->prepare('UPDATE budget SET category_name=:category_name, amount=:amount WHERE category_name=$category');
  $stmtTopics->bindValue(':category_name', $category_name);
  $stmtTopics->bindValue(':amount', $amount);
  $stmtTopics->execute();
  */
}

?>