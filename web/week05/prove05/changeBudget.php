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

$stmt = $db->prepare('INSERT INTO budget(category_name, amount) VALUES (:category_name, :amount)');
$stmt->bindParam(':category_name', $category_name);
$stmt->bindParam(':amount', $amount);
//$stmt->binValues(':category_name', $category_name, PDO::PARAM_STR);
//$stmt->binValues(':amount', $amount, PDO::PARAM_INT);
$stmt->execute();
//$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
//print_r($rows);

$stmt = $db->prepare('SELECT amount FROM budget WHERE category_name=:category_name');
$stmt->bindParam(':category_name', $category_name);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($rows);

//$new_page = "index.php";

//header("Location: $new_page");
//die();

?>