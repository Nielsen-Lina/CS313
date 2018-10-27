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
$company_name = htmlspecialchars($_POST['comapny_name']);

$company_chk = !empty($_POST['company_chk']) ? $_POST['company_chk'] : [];

foreach ($company_chk as $company)
{
  $stmt = $db->prepare('DELETE FROM detail WHERE detail_id=:detail_id');
  $stmt->bindValue(':detail_id', (int)$company);
  $stmt->execute();
}

$new_page = "index.php";
header("Location: $new_page");
die();

?>