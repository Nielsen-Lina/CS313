<?php

include('includes/header.php');
include('includes/navbar.php');

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

echo "<main>";

$sql_2 = 'SELECT detail.company_name, expense.transaction_amount, expense.purchase_date FROM detail JOIN expense ON detail.detail_id=expense.detail_id';
$stmt = $db->query($sql_2);
$names = $stmt;

echo "<h2>Transaction List: </h2>";
echo "<table><tr><th>Company name</th><th>Transaction amount</th><th>Purchase date</th></tr>";
foreach ($names as $name)
{
	echo "<tr><td>" . $name['company_name'] . "</td><td>" . $name['transaction_amount'] . "</td><td>" . $name['purchase_date'] . "</td></tr>";
}
echo "</table>";

echo "</main>";

include('includes/footer.php');

?>