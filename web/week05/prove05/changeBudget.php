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

echo $category_name;
echo $amount;

$stmt = $db->prepare('INSERT INTO budget(category_name, amount) VALUES (:category_name, :amount)');
$stmt->binValues(':category_name', $category_name, PDO::PARAM_STR);
$stmt->binValues(':amount', $amount, PDO::PARAM_INT);
$stmt->execute();

$new_page = "index.php";

header("Location: $new_page");
die();

?>