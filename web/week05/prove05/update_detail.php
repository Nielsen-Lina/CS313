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

$company_name = ucfirst($company_name);
$category_name = ucfirst($category_name);

$company_chk = !empty($_POST['company_chk']) ? $_POST['company_chk'] : [];

foreach ($company_chk as $company)
{
  if (isset($_POST["update_company"]))
  {
    $stmt = $db->prepare('UPDATE detail SET company_name=:company_name WHERE detail_id=:detail_id');
    $stmt->bindValue(':detail_id', (int)$company);
    $stmt->bindValue(':company_name', $company_name);
    $stmt->execute();
  }
  elseif (isset($_POST["update_category"]))
  {
    $stmtId = $db->prepare('SELECT category_id FROM budget WHERE category_name=:category_name');
    $stmtId->bindValue(':category_name', ucfirst($category_name));
    $stmtId->execute();
    $id = $stmtId->fetch(PDO::FETCH_ASSOC);

    $stmt = $db->prepare('UPDATE detail SET category_id=:category_id WHERE detail_id=:detail_id');
    $stmt->bindValue(':detail_id', (int)$company);
    $stmt->bindValue(':category_id', $id['category_id']);
    $stmt->execute();
  }
  
}

$new_page = "index.php";
header("Location: $new_page");
die();

?>