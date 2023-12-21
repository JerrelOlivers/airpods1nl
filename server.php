<?php
session_start();

$username = "";
$email = "";
$errors = array();

$db = mysqli_connect("localhost","root","","db_airpods");

if (isset($_POST['regUser'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password1 = mysqli_real_escape_string($db, $_POST['password1']);
    $password2 = mysqli_real_escape_string($db, $_POST['password2']);


    if (empty($username)) { array_push($errors, "Username is required!");}
    if (empty($email)) { array_push($errors, "Email is required!");}
    if (empty($password1)) { array_push($errors, "Password is required!");}
    if ($password1 != $password2) {
        array_push($errors,"The two passwords do not match!");

    }

    $checkIfUserAlrExist = "SELECT * FROM users WHERE username='$username'  OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $checkIfUserAlrExist);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($user['username'] === $username) {
            array_push($errors, 'Username already exists');
        }

        if ($user['email'] === $email) {
            array_push($errors,'email already exists');
    }
    }


        if (count($errors) == 0) {
            $password = md5($password1);

            $query = "INSERT INTO users (username, email, password)
                        VALUES('$username', '$email', '$password')";
            mysqli_query($db, $query);
            $_SESSION['username'] = $username;
            $_SESSION['session'] = "You are now logged in";
            header('location: ../html/newindex.html');

    }
}


// LOGIN GEDEELTE
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
        array_push($errors,'Username is required');
    }

    if (empty($password)) {
        array_push($errors,'Password is required');
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION["username"] = $username;
            $_SESSION["success"] = "You are now logged in";
            header('location: ../html/newindex.html');
        } else {
            array_push($errors,'Wrong username/password combination');

        } 

    
    }
}
