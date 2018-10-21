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


$sql_2 = 'SELECT detail.company_name, expense.transaction_amount, expense.purchase_date FROM detail JOIN expense ON detail.detail_id=expense.detail_id';
$stmt = $db->query($sql_2);
//$stmt->execute(array(':detail_id' => 15));
$names = $stmt;
print_r($names);

echo "<ul>";
foreach ($names as $name)
{
	echo "<li>" . $name['company_name'] . " " . $name['transaction_amount'] . " " . $name['purchase_date'] . "</li>";
}
echo "</ul>";
?>