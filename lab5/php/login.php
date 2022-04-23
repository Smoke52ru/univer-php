<?php include('./server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<form method="post" action="login.php">
    <?php include('errors.php'); ?>
    <label>
        Login
        <input type="text" name="login">
    </label>

    <label>
        Password
        <input type="password" name="password">
    </label>
    <input type="submit" name="login_user"/>
    <p>
        Not yet a member? <a href="registration.php">Sign up</a>
    </p>
</form>

</body>
</html>