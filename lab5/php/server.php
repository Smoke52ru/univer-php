<?php
session_start();

$login = "";
$password = "";
$passwordConfirm = "";
$username = "";
$birthdate = "";
$email = "";

$errors = array(); 


$db = mysqli_connect('localhost', 'root', '', 'univer');

// Registration logic
if (isset($_POST['reg_user'])) {
    $login = mysqli_real_escape_string($db, $_POST['login']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $passwordConfirm = mysqli_real_escape_string($db, $_POST['passwordConfirm']);
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $birthdate = mysqli_real_escape_string($db, $_POST['birthdate']);
    $email = mysqli_real_escape_string($db, $_POST['email']);


    // Validation
    if (empty($login)) { array_push($errors, "Username is required"); }
    if (empty($password)) { array_push($errors, "Password is required"); }
    if ($password != $passwordConfirm) {
        array_push($errors, "Passwords do not match");
    }
    if (empty($username)) { array_push($errors, "Name is required"); }
    if (empty($birthdate)) { array_push($errors, "Birthdate is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }


    // Check for user already exist in database
    $user_check_query = "SELECT * FROM users WHERE login='$login' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['login'] === $login) {
        array_push($errors, "Username already exists");
        }

        if ($user['email'] === $email) {
        array_push($errors, "email already exists");
        }
    }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {

        $query = "INSERT INTO users (login, password, name, birthdate, email) 
                    VALUES('$login', '$password', '$username', '$birthdate', '$email')";
        mysqli_query($db, $query);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
    }
}

// Logging in logic
if (isset($_POST['login_user'])) {
    $login = mysqli_real_escape_string($db, $_POST['login']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($login)) {
        array_push($errors, "Login is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        $query = "SELECT * FROM users WHERE login='$login' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";
          header('location: ../index.php');
        }else {
            array_push($errors, "Wrong login/password combination");
        }
    }
  }



