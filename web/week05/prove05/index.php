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

echo "<h1>Expense Management System</h1>";
echo "<h2>List of Budget Categories:</h2>";

$sql = 'SELECT category_id, category_name FROM budget';
$stmt = $db->query($sql);
$rows = $stmt;


foreach ($rows as $row)
{
  echo "<a href='details.php?category_id=" . $row['category_id'] . "'>More Details >> </a>";
  echo "<b>" . $row['category_name'] . " </b>";
  //echo "<b>" . $row['amount'] . "</b>";
  echo '<br/>';
}

?>