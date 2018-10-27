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
  /*
  $stmt = $db->prepare('UPDATE budget SET category_name=:category_name, amount=:amount WHERE category_id=:category_id');
  $stmt->bindValue(':category_id', (int)$category);
  $stmt->bindValue(':category_name', $category_name);
  $stmt->bindValue(':amount', $amount);
  $stmt->execute();
  */
  if (isset($_POST["update_category"]))
  {
    $stmt = $db->prepare('UPDATE budget SET category_name=:category_name WHERE category_id=:category_id');
    $stmt->bindValue(':category_id', (int)$category);
    $stmt->bindValue(':category_name', ucfirst($category_name));
    $stmt->execute();
  }
  elseif (isset($_POST["update_amount"]))
  {
    $stmt = $db->prepare('UPDATE budget SET amount=:amount WHERE category_id=:category_id');
    $stmt->bindValue(':category_id', (int)$category);
    $stmt->bindValue(':amount', $amount);
    $stmt->execute();
  }
  
}

$new_page = "change.php";
header("Location: $new_page");
die();

?>