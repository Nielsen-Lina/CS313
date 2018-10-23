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

$newTopic = filter_input(INPUT_POST, 'newTopic', FILTER_SANITIZE_STRING);
$book = filter_input(INPUT_POST, 'book', FILTER_SANITIZE_STRING);
$chapter = filter_input(INPUT_POST, 'chapter', FILTER_SANITIZE_STRING);
$verse = filter_input(INPUT_POST, 'verse', FILTER_SANITIZE_STRING);
$content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
/*
$stmtT = $db->prepare('SELECT name FROM Topic');
$stmtT-> execute();
$existingTopics = $stmtT->fetchAll(PDO::FETCH_ASSOC);
foreach ($existingTopics as $exTopic) 
{
  if ($newTopic != $exTopic['name']) {*/
    //$stmt = $db->prepare('INSERT INTO Topic(name) VALUES (:name)');
    //$stmt->execute(array(":name" => $newTopic));
  /*}
}*/

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
 <h1>Scripture and Topic List</h1>

<?php

  // For this example, we are going to make a call to the DB to get the scriptures
  // and then for each one, make a separate call to get its topics.
  // This could be done with a single query (and then more processing of the resultset
  // afterward) as follows:
  //  $statement = $db->prepare('SELECT book, chapter, verse, content, t.name FROM scripture s'
  //  . ' INNER JOIN scripture_topic st ON s.id = st.scriptureId'
  //  . ' INNER JOIN topic t ON st.topicId = t.id');

  // prepare the statement
  $statement = $db->prepare('SELECT id, book, chapter, verse, content FROM Scriptures');
  $statement->execute();
  // Go through each result
  while ($row = $statement->fetch(PDO::FETCH_ASSOC))
  {
    echo '<p>';
    echo '<strong>' . $row['book'] . ' ' . $row['chapter'] . ':';
    echo $row['verse'] . '</strong>' . ' - ' . $row['content'];
    echo '<br />';
    echo 'Topics: ';
    // get the topics now for this scripture
    $stmtTopics = $db->prepare('SELECT name FROM Topic t'
      . ' INNER JOIN Link st ON st.topicid = t.id'
      . ' WHERE st.scriptureid = :scriptureid');
    $stmtTopics->bindValue(':scriptureid', $row['id']);
    $stmtTopics->execute();
    // Go through each topic in the result
    while ($topicRow = $stmtTopics->fetch(PDO::FETCH_ASSOC))
    {
      echo $topicRow['name'] . ' ';
    }
    echo '</p>';
  }

?>
 </body>
</html>