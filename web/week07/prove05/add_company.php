<?php

session_start();

if (!empty($_SESSION['username']) && !empty($_SESSION['password']))
{
    require("dbConnect.php");
    $db = get_db();
}
else
{
    header("Location: login.php");
    die();
}

$category_name = htmlspecialchars($_POST['category_name']);
$company_name = htmlspecialchars($_POST['company_name']);

if (!isset($category_name) || trim($category_name) == '' || !isset($company_name) || trim($company_name) == '')
{
  include('error.php');
}
else
{
  $res = $db->query('SELECT count(*) FROM detail');
  $detail_id = $res->fetchColumn();
  (int)($detail_id += 1);

  $stmtName = $db->prepare('SELECT category_name FROM budget');
  $stmtName->execute();
  $category_name_findings = $stmtName->fetchAll(PDO::FETCH_ASSOC);
  foreach ($category_name_findings as $name)
  {
    echo $name['category_name'];
    echo ucfirst($category_name) . "<br>";
    if ($name['category_name'] == (ucfirst($category_name)))
    {/*
        $stmtId = $db->prepare('SELECT category_id FROM budget WHERE category_name=:category_name');
        $stmtId->bindValue(':category_name', ucfirst($category_name), PDO::PARAM_STR);
        $stmtId->execute();
        $category_id = $stmtId->fetch(PDO::FETCH_ASSOC);
        print_r($category_id['category_id']);

        $stmt = $db->prepare('INSERT INTO detail(detail_id, company_name, category_id) 
          VALUES (:detail_id, :company_name, :category_id)');
        $stmt->bindValue(':detail_id', $detail_id, PDO::PARAM_INT);
        $stmt->bindValue(':company_name', ucfirst($company_name), PDO::PARAM_STR);
        $stmt->bindValue(':category_id', $category_id['category_id'], PDO::PARAM_INT);
        $stmt->execute();

        //$new_page = "change.php";
        //header("Location: $new_page");
        //die();*/
        echo "here";
    }
    else 
    {
      header("Location: error.php");
      die();
    }*/
  }

  
}

?>