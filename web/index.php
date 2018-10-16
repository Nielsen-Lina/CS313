<?php

  //phpinfo();

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

foreach ($db->query('SELECT username, password FROM note_user') as $row)
{
  echo 'user: ' . $row['username'];
  echo ' password: ' . $row['password'];
  echo '<br/>';
}

$statement = $db->query('SELECT username, password FROM note_user');
while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{
  echo 'user: ' . $row['username'] . ' password: ' . $row['password'] . '<br/>';
}

// didn't produce any output
$statement = $db->query('SELECT username, password FROM note_user');
//$statement = $db->prepare('SELECT username, password FROM note_user');
//$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
print_r($results);
echo "<br>";

$id = 1;
$username = 'john';

$stmt = $db->prepare('SELECT * FROM note_user WHERE id=:id AND username=:username');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($rows);
echo "<br>";

$stmt = $db->prepare('SELECT * FROM note_user WHERE id=:id AND username=:username');
$stmt->execute(array(':username' => 'jane', ':id' => 2));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($rows);
echo "<br>";
/*
if($rows == $stmt->fetchAll(PDO::FETCH_ASSOC)){
        echo "Found <br>";
        print_r($rows);
 }else{
        echo "Not found <br>";
 }
*/
/*
foreach ($db->query('SELECT book, chapter, verse, content FROM Scriptures') as $row)
{
  echo "<b>" . $row['book'] . " </b>";
  echo "<b>" . $row['chapter'] . ":</b>";
  echo "<b>" . $row['verse'] . "</b> - <q>";
  echo $row['content'] . "</q>";
  echo '<br/>';
}
*/
?>