<?php

include('includes/header.php');
include('includes/navbar.php');  

session_start();

if (!empty($_SESSION['username']) && !empty($_SESSION['password']))
{
    require("dbConnect.php");
    $db = get_db();
}
else
{
    header("Location: login.php");
    die();
}

echo "<main>";

echo "<h1>Overview</h1>";
echo "<h2>List of Budget Categories:</h2>";

$sql = 'SELECT category_id, category_name FROM budget ORDER BY category_name';
$stmt = $db->query($sql);
$rows = $stmt;

foreach ($rows as $row)
{
  echo "<a href='details.php?category_id=" . $row['category_id'] . "'>" . $row['category_name'] . "</a><br/>";
}

?>

<h2><a href='transactions.php'>List of Transactions</a></h2>
<h2>List of Companies for a chosen Category:</h2>
<form method="GET" action="index.php">
  <input type="text" name="category_name" placeholder="category name">
  <input type="submit" value="Search">
</form>

<?php

$category_name = htmlspecialchars($_GET['category_name']);
$sql_1 = 'SELECT category_id FROM budget WHERE lower(category_name)=lower(:category_name)';

$stmt = $db->prepare($sql_1);
$stmt->bindValue(':category_name', $category_name, PDO::PARAM_STR);
$stmt->execute();
$id = $stmt->fetch(PDO::FETCH_ASSOC);
$id = $id['category_id'];
//print_r($id);

$sql_2 = 'SELECT company_name FROM detail WHERE category_id=:category_id';
//$sql_2 = 'SELECT detail.company_name FROM budget JOIN detail ON budget.category_id=detail.category_id';
//$stmt = $db->query($sql_2);
//$names = $stmt;
$statement = $db->prepare($sql_2);
$statement->bindParam(':category_id', $id);
$statement->execute();
$names = $statement->fetchAll(PDO::FETCH_ASSOC);

echo "<ul>";
foreach ($names as $name)
{
  echo "<li>" . $name['company_name'] . "</li>";
}
echo "</ul>";
echo "<br>";
?>

</main>

<?php 
  include('includes/footer.php');
?>

