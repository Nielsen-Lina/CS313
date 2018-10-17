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
foreach ($db->query('SELECT id, book, chapter, verse FROM Scriptures') as $row)
{
  echo "<b>" . $row['book'] . " </b>";
  echo "<b>" . $row['chapter'] . ":</b>";
  echo "<b>" . $row['verse'] . "</b>";
  echo '<br/>';
}

$book = htmlspecialchars($_GET['book']);

$stmt = $db->prepare('SELECT id, book, chapter, verse FROM Scriptures WHERE lower(book)=lower(:book)');
$stmt->execute(array(':book' => $book));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>Search Results</h2>";
foreach ($rows as $row) {
  echo "<a href='details.php?id=" . $row['id'] . "'>View Details</a>";
  echo "<b>" . $row['book'] . " </b>";
  echo "<b>" . $row['chapter'] . ":</b>";
  echo "<b>" . $row['verse'] . "</b>";
  echo '<br/>';
}

?>

<form method="GET" action="index.php">
	<input type="text" name="book"><br>
	<input type="submit" value="Search">
</form>