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

echo "<h1>Scripture Resources</h1>";
foreach ($db->query('SELECT book, chapter, verse, content FROM Scriptures') as $row)
{
  echo "<b>" . $row['book'] . " </b>";
  echo "<b>" . $row['chapter'] . ":</b>";
  echo "<b>" . $row['verse'] . "</b> - <q>";
  echo $row['content'] . "</q>";
  echo '<br/>';
}

$book = htmlspecialchars($_GET['book']);

$stmt = $db->prepare('SELECT * FROM Scriptures WHERE tolower(book)=tolower(:book)');
$stmt->execute(array(':book' => $book));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>Search Results</h2>";
foreach ($rows as $row) {
  echo "<b>" . $row['book'] . " </b>";
  echo "<b>" . $row['chapter'] . ":</b>";
  echo "<b>" . $row['verse'] . "</b> - <q>";
  echo $row['content'] . "</q>";
  echo '<br/>';
}

?>

<form method="GET" action="index.php">
	<input type="text" name="book"><br>
	<input type="submit" value="Search">
</form>