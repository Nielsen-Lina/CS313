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


$id = htmlspecialchars($_GET['category_id']);
$sql = 'SELECT category_id, category_name, amount FROM budget WHERE category_id=:category_id';

$stmt = $db->prepare($sql);
$stmt->execute(array(':category_id' => $id));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as $row) {
  echo "<h2>More Details about " . $row['category_name'] . ":</h2>";

  echo $row['category_name'] . " category has " . $row['amount'] . " allowance.";
  echo '<br/>';
}

echo "<h3>Transactions in this category this month: </h3>";
$sql_1 = 'SELECT detail_id FROM detail WHERE lower(category_id)=lower(:category_id)';

$stmt = $db->prepare($sql_1);
$stmt->execute(array(':category_id' => $id));
$id = $stmt->fetch(PDO::FETCH_ASSOC);
$id = $id['detail_id'];
print_r($id);

?>