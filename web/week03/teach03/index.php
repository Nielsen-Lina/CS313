<?php
include_once './_data.php';
?>
<html>
    <head>
        <style>
            label {
                display: block;
            }
            li {
                list-style: none;
            }
        </style>
    </head>
    <body>
        <form method="post" action="post.php">
            <label for="name">
                    Name        

            <input type="text" name="name" id="name" />
            </label>
            <label>
                    Email
                <input type="email" name="email" />
            </label>
            <?php foreach ($majors as $abbr => $major) : ?>
                <label>
                    <input type="radio" name="major" value="<?= $abbr; ?>"/>
                    <?= $major; ?>
                </label>
            <?php endforeach; ?>
            <label>
                Comments:
                <textarea name="comments"></textarea>
            </label>
            Visited Continents:
            <ul>
                <li>
                    <?php foreach ($continents as $abbr => $name) : ?>
                    <label>
                        <input type="checkbox" name="visited[]" value="<?= $abbr; ?>"/>
                        <?= $name; ?>
                    </label>
                    <?php endforeach; ?>
                </li>
            </ul>
            <div>
                <input type="submit" name="action" value="Submit"
            </div>
        </form>
    </body>

</html>