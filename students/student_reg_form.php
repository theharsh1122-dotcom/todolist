<?php

include "../config/database.php";

if (isset($_POST['register'])) {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $student_type = $_POST['student_type'];
    $class_course = $_POST['class_course'];

    $query = "INSERT INTO students
    (first_name, last_name, father_name, mother_name, email, phone, date_of_birth, gender, address, student_type, class_course)
    VALUES
    ('$first_name', '$last_name', '$father_name', '$mother_name', '$email', '$phone', '$date_of_birth', '$gender', '$address', '$student_type', '$class_course')";

    if (mysqli_query($conn, $query)) {

        header("Location: student.php");
        exit();

    } else {

        $error = "Student registration failed!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Registration</title>
    <link rel="stylesheet" href="../assets/css/student_reg.css">
</head>

<body>

<div class="student-container">

    <h1>Student Registration</h1>

    <?php
    if (isset($error)) {
        echo "<p class='error'>$error</p>";
    }
    ?>

    <form method="POST">

        <label>First Name</label>
        <input type="text" name="first_name" placeholder="Enter First Name" required>

        <label>Last Name</label>
        <input type="text" name="last_name" placeholder="Enter Last Name" required>

        <label>Father Name</label>
        <input type="text" name="father_name" placeholder="Enter Father Name" required>

         <label>Mother Name</label>
        <input type="text" name="mother_name" placeholder="Enter Mother Name" required>
        <label>Email</label>
        <input type="email" name="email" placeholder="Enter Email">

        <label>Phone</label>
        <input type="tel" name="phone" placeholder="Enter Phone Number" required>

        <label>Date of Birth</label>
        <input type="date" name="date_of_birth" required>

        <label>Gender</label>

        <input type="radio" name="gender" value="Male" required> Male
        <input type="radio" name="gender" value="Female"> Female
        <input type="radio" name="gender" value="Other"> Other

        <label>Address</label>
        <textarea name="address" placeholder="Enter Address" required></textarea>

        <label>Student Type</label>

        <select name="student_type" required>
            <option value="">Select Student Type</option>
            <option value="School">School</option>
            <option value="College">College</option>
        </select>

         <label>Class / Course</label>
        <input type="text" name="class_course" placeholder="Enter Class or Course" required>

        <button type="submit" name="register">
            Register Student
        </button>

    </form>

</div>

</body>
</html>