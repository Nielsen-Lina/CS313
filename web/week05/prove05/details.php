<?php

include('includes/header.php');
include('includes/navbar.php');

require("dbConnect.php");
$db = get_db();

echo "<main>";
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
//print_r($det_id);
//echo "<br>";

echo "<h3>Transaction list for this category: </h3>";
echo "<table><tr><th>Company name</th><th>Transaction amount</th></tr>";
foreach ($det_id as $id) 
{
  echo "<tr><td>" . $id['company_name'] . "</td>";

  $detail_id = $id['detail_id'];

  $sql_2 = 'SELECT transaction_amount FROM expense WHERE detail_id=:detail_id';

  $stmt = $db->prepare($sql_2);
  $stmt->execute(array(':detail_id' => $detail_id));
  $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
  //$det_id = $det_id['detail_id'];
  //print_r($transactions);
 // echo "<br>";

  $total = 0;
  foreach ($transactions as $transaction)
  {
    echo "<td>" . $transaction['transaction_amount'] . "</td>";
  }
  echo "</tr>";
}
echo "</table>";

echo "</main>";

include('includes/footer.php');

?>