<?php
session_start();
include "database.php";

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users
              WHERE username='$username'
              AND password='$password'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        header("Location: dashboard.php");
        exit();

    } else {

        $error = "Username or password incorrect!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Todo List</title>

    <link rel="stylesheet" href="login.css">
</head>

<body>

<div class="login-container">

    <h1>Login Todo List</h1>

    <?php
    if (isset($error)) {
        echo "<p class='error'>$error</p>";
    }
    ?>

    <form method="POST">

        <input
            type="text"
            name="username"
            placeholder="Enter the username"
            required
        >

        <input
            type="password"
            name="password"
            placeholder="Enter the password"
            required
        >

        <button type="submit" name="login">
            Login
        </button>

    </form>

    <p class="register-link">
        Don't have an account?
        <a href="register.php">Create Account</a>
    </p>

</div>

</body>
</html>