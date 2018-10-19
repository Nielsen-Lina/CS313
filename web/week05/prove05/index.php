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

<form method="GET" action="index.php">
  <input type="text" name="category_name"><br>
  <input type="submit" value="Search">
</form>

<?php

$category = htmlspecialchars($_GET['category_name']);

$stmt = $db->prepare('SELECT category_id FROM budget WHERE ucfirst(category_name)=ucfirst(:category_name)');
//$stmt->bindValue(':category_name', $category, PDO::PARAM_STR);
$stmt->execute();
//$stmt->execute(array(':book' => $book));
$rows = $stmt->fetch(PDO::FETCH_ASSOC);
print_r($rows);

?>