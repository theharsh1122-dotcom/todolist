<?php
include "database.php";

if (isset($_POST['register'])) {

<<<<<<< HEAD
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];

    $check = "SELECT * FROM users  WHERE username='$username'  OR email='$email'  OR phone='$phone'";

    $result = mysqli_query($conn, $check);

    if (mysqli_num_rows($result) > 0) {

        $error = "User already registered ";

    } else {

        $query = "INSERT INTO users 
        (first_name, last_name, email, phone, username, password, gender)
        VALUES
        ('$first_name', '$last_name', '$email', '$phone', '$username', '$password', '$gender')";

 if (mysqli_query($conn, $query)) {
   header("Location: login.php");
     exit();
 } else {
            $error = "Account not created!";
             }
 }
=======
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "INSERT INTO users (username, password)
              VALUES ('$username', '$password')";

    if (mysqli_query($conn, $query)) {

        header("Location: login.php");
        exit();

    } else {

        $error = "Account create nahi hua: " . mysqli_error($conn);
    }
>>>>>>> 8ecd669587ab1381eeb278c21d72d42763fa0744
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Account</title>
<<<<<<< HEAD
=======

>>>>>>> 8ecd669587ab1381eeb278c21d72d42763fa0744
    <link rel="stylesheet" href="register.css">
</head>

<body>

<div class="register-container">

    <h1>Create Account</h1>

    <?php
    if (isset($error)) {
        echo "<p class='error'>$error</p>";
    }
    ?>

    <form method="POST">
<<<<<<< HEAD
         <label>First Name</label>
        <input type="text" name="first_name" placeholder="Enter First Name"required>
        
        <label>Last Name</label>
        <input type="text" name="last_name" placeholder="Enter Last Name" required>
        
        <label>Email-Id</label>
        <input type="email" name="email" placeholder="Enter Email" required>
        
        <label>Phone-No</label>
        <input type="tel" name="phone" placeholder="Enter Phone Number" required>
        
        <label>Username</label>
        <input type="text" name="username" placeholder="Enter Username" required>
    
        <label>Password</label>
        <input type="password" name="password"placeholder="Enter Password" required>
       <label>Gender</label>
       <input type="radio" name="gender" value="Male" required>Male
       <input type="radio" name="gender" value="Female">Female
       <input type="radio" name="gender" value="Other">Other
    
       <button type="submit" name="register">
            Create Account
        </button>
    </form>
    <p class="login-link">
        Already have an account!
=======

        <input type="text" name="username"
               placeholder="Enter the username" required>

        <input type="password" name="password"
               placeholder="Enter the password" required>

        <button type="submit" name="register">
            Create Account
        </button>

    </form>

    <p class="login-link">
        Already have an account?
>>>>>>> 8ecd669587ab1381eeb278c21d72d42763fa0744
        <a href="login.php">Login</a>
    </p>

</div>

</body>
</html>