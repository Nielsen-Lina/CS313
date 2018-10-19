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
$sql = 'SELECT category_id, category_name, amount FROM budget WHERE id=:category_id';

$stmt = $db->prepare($sql);
$stmt->execute(array(':category_id' => $id));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>Search Results</h2>";
foreach ($rows as $row) {
  echo "<b>" . $row['category_name'] . " </b>";
  echo "<b>" . $row['amount'] . ":</b>";
  echo '<br/>';
}

?>