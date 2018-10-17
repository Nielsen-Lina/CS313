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

foreach ($db->query('SELECT book, chapter, verse, content FROM Scriptures') as $row)
{
  echo "<b>" . $row['book'] . " </b>";
  echo "<b>" . $row['chapter'] . ":</b>";
  echo "<b>" . $row['verse'] . "</b> - <q>";
  echo $row['content'] . "</q>";
  echo '<br/>';
}

?>