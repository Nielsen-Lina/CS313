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

$category_id = 0;

$stmt = $db->prepare('SELECT category_id FROM budget');
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($rows);
/*
$stmt = $db->prepare('INSERT INTO budget(category_name, amount) 
	VALUES (:category_name, :amount)');
//$stmt->bindValue(':category_id', 11, PDO::PARAM_INT);
$stmt->bindValue(':category_name', $category_name, PDO::PARAM_STR);
//$stmt->execute(array(':category_id' => 10, ':category_name' => $category_name, ':amount' => $amount));
$stmt->bindValue(':amount', $amount, PDO::PARAM_INT);
//$stmt->binValues(':category_name', $category_name, PDO::PARAM_STR);
//$stmt->binValues(':amount', $amount, PDO::PARAM_INT);
$stmt->execute();
//$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
//print_r($rows);
*/
/*
$stmt = $db->prepare('SELECT amount FROM budget WHERE category_name=:category_name');
$stmt->bindParam(':category_name', $category_name);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($rows);
*/
//$new_page = "index.php";

//header("Location: $new_page");
//die();

?>