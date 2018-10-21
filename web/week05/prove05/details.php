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

$sql_1 = 'SELECT company_name, detail_id FROM detail WHERE category_id=:category_id';

$stmt = $db->prepare($sql_1);
$stmt->execute(array(':category_id' => $id));
$det_id = $stmt->fetchAll(PDO::FETCH_ASSOC);
//$det_id = $det_id['detail_id'];
print_r($det_id);
echo "<br>";
 foreach ($det_id as $id) {
  echo $id['company_name'] . "<br>";
 }


/*
echo "<br>";
$sql_2 = 'SELECT detail.company_name, expense.transaction_amount, expense.purchase_date FROM detail JOIN expense ON detail.detail_id=expense.detail_id';
$stmt = $db->query($sql_2);
//$stmt->execute(array(':detail_id' => 15));
$names = $stmt;
print_r($names);

echo "<ul>";
foreach ($names as $name)
{
  foreach ($det_id as $id) 
  {
    if ($name['detail_id'] == $id) 
    {
      echo "<li>" . $name['company_name'] . " " . $name['transaction_amount'] . " " . $name['purchase_date'] . "</li>";
    }
  }
}
echo "</ul>";
*/
?>