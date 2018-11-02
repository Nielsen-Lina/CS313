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
$match = false;

$new_page = "change.php";

$company_name = ucfirst($company_name);
$category_name = ucfirst($category_name);

$company_chk = !empty($_POST['company_chk']) ? $_POST['company_chk'] : [];

foreach ($company_chk as $company)
{
  if (isset($_POST["update_company"]))
  {
    if (!isset($company_name) || trim($company_name) == '')
    {
      $new_page = "error.php";
    }
    else
    {
      $stmt = $db->prepare('UPDATE detail SET company_name=:company_name WHERE detail_id=:detail_id');
      $stmt->bindValue(':detail_id', (int)$company);
      $stmt->bindValue(':company_name', $company_name);
      $stmt->execute();
    }
  }
  elseif (isset($_POST["update_category"]))
  {
    if (!isset($category_name) || trim($category_name) == '')
    {
      $new_page = "error.php";
    }
    else
    {
      $stmtName = $db->prepare('SELECT category_name FROM budget');
      $stmtName->execute();
      $category_name_findings = $stmtName->fetchAll(PDO::FETCH_ASSOC);
      foreach ($category_name_findings as $name)
      {
        $one = $name['category_name'];
        $two = ucfirst($category_name);
        if (strcmp($one, $two) == 0)
        {
            $match = true;
        }
      }

      if ($match)
      {
        $stmtId = $db->prepare('SELECT category_id FROM budget WHERE category_name=:category_name');
        $stmtId->bindValue(':category_name', ucfirst($category_name));
        $stmtId->execute();
        $id = $stmtId->fetch(PDO::FETCH_ASSOC);

        $stmt = $db->prepare('UPDATE detail SET category_id=:category_id WHERE detail_id=:detail_id');
        $stmt->bindValue(':detail_id', (int)$company);
        $stmt->bindValue(':category_id', $id['category_id']);
        $stmt->execute();
      }
      else
      {
        header("Location: error.php");
        die();
      }
    }
  }
}

header("Location: $new_page");
die();

?>