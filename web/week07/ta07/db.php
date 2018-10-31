<?php
function getDBURL() {
	
	// could expand this to include a local config option.
	$dbUrl = getenv('DATABASE_URL');
	return $dbUrl;
}
/**
 * @return PDO
 */
function openDBConnection() {
	
	try {
		$dbUrl = getDBURL();
		$dbOpts = parse_url($dbUrl);
		$dbHost = $dbOpts["host"];
		$dbPort = $dbOpts["port"];
		$dbUser = $dbOpts["user"];
		$dbPassword = $dbOpts["pass"];
		$dbName = ltrim($dbOpts["path"], '/');
		$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $db;
	}
	catch (PDOException $ex)
	{
		echo 'Error!: ' . $ex->getMessage();
		throw $ex;
	}
}
function resultToArray($result) {
	$arr = [];
	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $arr[] = $row;
	}
	return $arr;
}
function getSingleArrayFromQuery($query, $preparedValues, $db) {
	$result = getArrayFromQuery($query, $preparedValues, $db);
	if (!empty($result)) {
		return $result[0];
	}
	return null;
}
function getArrayFromQuery($query, $preparedValues, $db) {
	$preparedStatement = $db->prepare($query);
	$preparedStatement->execute($preparedValues);
	return resultToArray($preparedStatement);
}
function executeQuery($query, $preparedValues, $db) {
	$preparedStatement = $db->prepare($query);
	$preparedStatement->execute($preparedValues);
}
function logSelectActivity(array $viewedRecords, $entityTable, $db) {
	$statement = 'select activity_log_select(:table_name, :table_id)';
	$preparedStatement = $db->prepare($statement);
	foreach ($viewedRecords as $id) {
		$preparedStatement->execute(['table_name' => $entityTable, 'table_id' => $id]);
	}
}
function getLastInsertId($tableName, $db) {
	// since we use the PDO driver we need to grab the sequence here
	// normally it'd just be $db->lastInsertId(), but in psql we have to give the sequence
	$seqName = strtolower($tableName) . "_id_seq";
	return $db->lastInsertId($seqName);
}