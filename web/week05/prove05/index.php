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

$stmt = $db->prepare('SELECT category_id, category_name, amount FROM budget');
$stmt->execute(array());
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$category_chk = [];

?>

<br/>
<h2>Changes to the Expense Management System</h2>
<h3>Change a new budget category with its accompanied amount:</h3>
<form method="POST" action="add_budget.php">
  <input type="text" name="category_name" placeholder="category name">
  <input type="text" name="amount" placeholder="amount">
  <input type="submit" value="Add"><br>
  <?php foreach ($rows as $row) : ?>
    <?php echo $row['category_name']; ?>: <input type="checkbox" name="category_chk[]" value="<?= $row['category_id']; ?>" />
  <?php endforeach; ?>
  <!--<input type="submit" name="update_category" formaction="update_budget.php" value="Update Category">
  <input type="submit" name="update_amount" formaction="update_budget.php" value="Update Amount">-->
  <input type="submit" formaction="delete_budget.php" value="Delete">
</form>
<h3>Change a new company name with its accompanied budget category:</h3>
<form method="POST" action="changeCompany.php">
  <input type="text" name="company_name" placeholder="company name">
  <input type="text" name="category_name" placeholder="category name">
  <input type="submit" value="Add">
  <input type="submit" value="Update">
  <input type="submit" value="Delete">
</form>
<h3>Change a new expense with its accompanied company name, amount and date of purchase:</h3>
<form method="POST" action="changeExpense.php">
  <input type="text" name="company_name" placeholder="company name">
  <input type="text" name="transaction_amount" placeholder="transaction amount">
  <input type="text" name="purchase_date" placeholder="purchase date">
  <input type="submit" value="Add">
  <input type="submit" value="Update">
  <input type="submit" value="Delete">
</form>

