<?php
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$majorAbbr = filter_input(INPUT_POST, 'major', FILTER_SANITIZE_STRING);
$comments = filter_input(INPUT_POST, 'comments', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$visitedValues = !empty($_POST['visited']) ? $_POST['visited'] : [];
include_once './_data.php';
$major = !empty($majors[$majorAbbr]) ? $majors[$majorAbbr] : '';
$cleanedValues = [];
foreach ($visitedValues as $item) {
    $abbr = htmlspecialchars($item);
    if (!empty($continents[$abbr])) {
        $cleanedValues[] = $continents[$abbr]; 
    }
}
if (empty($cleanedValues)) {
    $cleanedValues[] = "No continents have been visited";
}
?>
<html>
    <body>
        <div>
            Name: <?= $name; ?>
        </div>
        <div>
            Email: <a href="mailto:<?= $email; ?>"><?= $email; ?></a>
        </div>
        <div>
            Major: <?= $major; ?>
        </div>
        <div>
            Comments: <?= $comments; ?>
        </div>
        <div>
        Visited Continent: 
            <ul>
                <?php foreach ($cleanedValues as $value) : ?>
                    <li><?= $value; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </body>
</html>