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

$company_name = htmlspecialchars($_POST['company_name']);
$transaction_amount = htmlspecialchars($_POST['transaction_amount']);
$purchase_date = htmlspecialchars($_POST['purchase_date']);

$res = $db->query('SELECT count(*) FROM expense');
$expense_id = $res->fetchColumn();

(int)($expense_id += 1);
print_r($expense_id);

$stmtId = $db->prepare('SELECT detail_id FROM detail WHERE company_name=:company_name');
$stmtId->bindValue(':company_name', ucfirst($company_name), PDO::PARAM_STR);
$stmtId->execute();
$detail_id = $stmtId->fetch(PDO::FETCH_ASSOC);
print_r($detail_id['detail_id']);
/*
$stmt = $db->prepare('INSERT INTO expense(expense_id, detail_id, transaction_amount, purchase_date) 
	VALUES (:expense_id, :detail_id, :transaction_amount, :purchase_date)');
$stmt->bindValue(':expense_id', $expense_id, PDO::PARAM_INT)
$stmt->bindValue(':detail_id', (int)$detail_id['detail_id'], PDO::PARAM_INT);
$stmt->bindValue(':transaction_amount', $transaction_amount, PDO::PARAM_INT);
$stmt->bindValue(':purchase_date', $purchase_date);
$stmt->execute();

$new_page = "index.php";
header("Location: $new_page");
die();
*/
?>