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
$company_name = htmlspecialchars($_POST['company_name']);

if (!isset($category_name) || trim($category_name) == '' && !isset($company_name) || trim($company_name) == '')
{
  include('error.php');
}
else
{
  $res = $db->query('SELECT count(*) FROM detail');
  $detail_id = $res->fetchColumn();

  (int)($detail_id += 1);

  $stmtId = $db->prepare('SELECT category_id FROM budget WHERE category_name=:category_name');
  $stmtId->bindValue(':category_name', ucfirst($category_name), PDO::PARAM_STR);
  $stmtId->execute();
  $category_id = $stmtId->fetch(PDO::FETCH_ASSOC);

  $stmt = $db->prepare('INSERT INTO detail(detail_id, company_name, category_id) 
  	VALUES (:detail_id, :company_name, :category_id)');
  $stmt->bindValue(':detail_id', $detail_id, PDO::PARAM_INT);
  $stmt->bindValue(':company_name', ucfirst($company_name), PDO::PARAM_STR);
  $stmt->bindValue(':category_id', $category_id['category_id'], PDO::PARAM_INT);
  $stmt->execute();

  $new_page = "change.php";
  header("Location: $new_page");
  die();
}

?>