<?php

/** Details page

Figure out what scripture was selected
Connect to the database
Retrieve just that one scripture that was selected
display that scripture with its contents
**/

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

$id = htmlspecialchars($_GET['id']);

$stmt = $db->prepare('SELECT book, chapter, verse, content FROM Scriptures WHERE id=:id');
$stmt->execute(array(':id' => $id));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>Search Results</h2>";
foreach ($rows as $row) {
  echo "<b>" . $row['book'] . " </b>";
  echo "<b>" . $row['chapter'] . ":</b>";
  echo "<b>" . $row['verse'] . "</b>";
  echo $row['content'];
  echo '<br/>';
}

?>