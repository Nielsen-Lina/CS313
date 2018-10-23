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
$book = filter_input(INPUT_POST, 'book', FILTER_SANITIZE_STRING);
$chapter = filter_input(INPUT_POST, 'chapter', FILTER_SANITIZE_STRING);
$verse = filter_input(INPUT_POST, 'verse', FILTER_SANITIZE_STRING);
$content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
$topics = !empty($_POST['topics']) ? $_POST['topics'] : [];
$stmt = $db->prepare('INSERT INTO Scriptures(book, chapter, verse, content) 
VALUES (:book, :chapter, :verse, :content)');
$stmt->execute(array(":book" => $book, ":chapter" => $chapter, ":verse" => $verse
,":content" => $content));
$scriptureId = $db->lastInsertId('scriptures_id_seq');
$linkInsertStmt = $db->prepare("INSERT INTO Link(scriptureid, topicid)
VALUES(
	:scriptureId ,:id
)");
foreach ($topics as $topicId) {
	$cleanId = (int)$topicId;
	$linkInsertStmt->execute(array(":scriptureId" => $scriptureId, ":id" => $cleanId));
}
?>
<html>
 <head>
  <title>
  </title>
 </head>
 <body>
 
 </body>
</html>