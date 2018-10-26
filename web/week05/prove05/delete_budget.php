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
  $stmt = $db->prepare('DELETE FROM budget WHERE category_id=:category_id');
  $stmt->bindValue(':category_id', (int)$category);
  $stmt->execute();
}

$new_page = "index.php";
header("Location: $new_page");
die();

?>