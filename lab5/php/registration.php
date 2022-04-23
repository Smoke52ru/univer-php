<?php include('./server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <form action="registration.php" method="post">
        <?php include('./errors.php'); ?>
        <h3>Registration form</h3>
        <label>
            Login:
            <input type="text" name="login">
        </label>
        <label>
            Password:
            <input type="password" name="password">
        </label>
        <label>
            Confirm password:
            <input type="password" name="passwordConfirm">
        </label>
        <label>
            Your name:
            <input type="text" name="username">
        </label>
        <label>
            Birthdate:
            <input type="date" name="birthdate">
        </label>
        <label>
            E-mail:
            <input type="email" name="email">
        </label>
        <input type="submit" name="reg_user">
        <p>
  		    Already a member? <a href="./login.php">Sign in</a>
  	    </p>
    </form>
</body>
</html>