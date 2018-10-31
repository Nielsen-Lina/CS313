<?php
require_once "db.php";
$db = openDBConnection();
$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
$confirmPassword = filter_var($_POST['confirmPassword'], FILTER_SANITIZE_STRING);
$passwordsInvalid = false;
function validatePassword($password, $confirmPassword) {
    $errors = [];
    if ($password != $confirmPassword) {
        $errors[] = "Password and Confirm Password must match";
    }
    if ( strlen($password) < 7 || !preg_match('/[0-9]+/', $password) ) {
        $errors[] = 'Password must be at least 7 characters long and have at least 1 number.';
    }
    return $errors;
}
if (!empty($username)) {
    $errors = validatePassword($password, $confirmPassword);
    if (empty($errors)) {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $statement = "INSERT INTO UsersTest(username, password) VALUES(:username, :password)";
        executeQuery($statement, [':username' => $username, ':password' => $hash], $db);
        header("Location: signin.php");
        die();
    }
    else {
        $passwordsInvalid = true;
        $errorMessage = join('. ', $errors);
    }
}
?>
<html>
<body>
<script type="text/javascript">
    function validate(event) {
         var form = document.querySelector("form");
        var password = document.getElementById("password").value;
        var passwordConfirm = document.getElementById("confirmPassword").value;
        var errors = [];
        if (password != passwordConfirm) {
            errors.push("Password and Confirm Password must match");
        }
        if ( password.length < 7 || !(password.match(/[0-9]+/)) ) {
            errors.push('Password must be at least 7 characters long and have at least 1 number.');
        }
        if (errors.length > 0) {
            alert(errors.join(". "));
            return false;
        }
        else {
            form.submit();
        }
    }
</script>

<style>
input {
    display: inline-block;
}
.invalid{ 
        color: red;
        font-size: 14px;
}
</style>
<form action="" method="post">
    <?php if ($passwordsInvalid) : ?>
        <p class="invalid"><?php echo $errorMessage; ?></p>
    <?php endif; ?>
    <input type="text" name="username" id="username" placeholder="Username" />
    <input class="" type="password" name="password" id="password" placeholder="Password" />
    <?php if ($passwordsInvalid) : ?>
        <span class="invalid">*</span>
    <?php endif; ?>
    <input class="" type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" />
    <?php if ($passwordsInvalid) : ?>
        <span class="invalid">*</span>
    <?php endif; ?>
<input type="submit" value="Signup" onclick="return validate();">
</form>
</body>