<?php
$topics = [
1 => 'Charity'
,2 => 'Faith'
];
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
$stmt = $db->prepare('SELECT id,name FROM Topic');
$stmt->execute(array());
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
 <head>
  <title>insert scripture</title>
 </head>
 <body>
 <form action="details.php" method="post">
 Book: <input type="text" name="book"><br/>
 Chapter: <input type="text" name="chapter"><br/>
 Verse: <input type="text" name="verse"><br/>
 Content: <textarea name="content"></textarea><br/>
 <?php foreach ($rows as $row) : ?>
	 <?php echo $row['name']; ?>: <input type="checkbox" name="topics[]" value="<?= $row['id']; ?>" />
 <?php endforeach; ?>
 <textarea name="newTopic"></textarea><input type="checkbox" name="topic">
 <input type="submit">
 </form>
 </body>
</html>