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
  echo "<a href='details.php?category_id=" . $row['category_id'] . "'>" . $row['category_name'] . "</a>";
  //" More Details >> </a>";
  //echo "<b>" . $row['category_name'] . " </b>";
  //echo "<b>" . $row['amount'] . "</b>";
  //echo '<br/>';
}

?>
<br/>
<form method="GET" action="index.php">
  <input type="text" name="category_name">
  <input type="submit" value="Search">
</form>

<?php

$category_name = htmlspecialchars($_GET['category_name']);
$sql_1 = 'SELECT category_id FROM budget WHERE lower(category_name)=lower(:category_name)';

$stmt = $db->prepare($sql_1);
$stmt->bindValue(':category_name', $category_name, PDO::PARAM_STR);
$stmt->execute();
$id = $stmt->fetch(PDO::FETCH_ASSOC);
//print_r($id['category_id']);

$sql_2 = 'SELECT company_name FROM detail WHERE category_id=:category_id';

$stmt = $db->prepare($sql_2);
//$stmt->bindValue(':category_id', $id, PDO::PARAM_INT);
//$stmt->execute();
$stmt->execute(array(':category_id' => $id));
$names = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($names as $name)
{
  echo $name['company_name'] . "<br/>";
}

?>