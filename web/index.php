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

 if($results = $statement->fetchAll(PDO::FETCH_ASSOC)){
        echo "Found";
        print_r($results);
 }else{
        echo "Not found";
 }

$stmt = $db->prepare('SELECT * FROM note_user WHERE id=:id AND username=:username');
$stmt->bindValue(':id', 1, PDO::PARAM_INT);
$stmt->bindValue(':username', 'john', PDO::PARAM_STR);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($rows);

if($rows = $stmt->fetchAll(PDO::FETCH_ASSOC)){
        echo "Found";
        print_r($rows);
 }else{
        echo "Not found";
 }

$stmt = $db->prepare('SELECT * FROM note_user WHERE id=:id AND username=:username');
$stmt->execute(array(':username' => 'jane', ':id' => 2));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($rows);

if($rows = $stmt->fetchAll(PDO::FETCH_ASSOC)){
        echo "Found";
        print_r($rows);
 }else{
        echo "Not found";
 }

?>