<?php

include('includes/header.php');
include('includes/navbar.php');

require("dbConnect.php");
$db = get_db();

echo "<main>";

$sql_2 = 'SELECT detail.company_name, expense.transaction_amount, expense.purchase_date FROM detail JOIN expense ON detail.detail_id=expense.detail_id ORDER BY expense.purchase_date ASC';
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