<?php

include "../config/database.php";

$course_result = mysqli_query($conn, "SELECT id, course_name, course_code FROM courses ORDER BY course_name ASC");

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
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $student_type = $_POST['student_type'];

    if ($student_type == "School") {

        $class_course = $_POST['class_name'];

    } else {

        $course_id = $_POST['course_id'];

        $course_query = mysqli_query($conn, "SELECT course_name, course_code FROM courses WHERE id=$course_id");

        $course_data = mysqli_fetch_assoc($course_query);

        $class_course = $course_data['course_name'] . " - " . $course_data['course_code'];
    }

    $query = "INSERT INTO students
    (first_name, last_name, father_name, mother_name, email, phone, date_of_birth, gender, student_type, class_course)
    VALUES
    ('$first_name', '$last_name', '$father_name', '$mother_name', '$email', '$phone', '$date_of_birth', '$gender', '$student_type', '$class_course')";

    if (mysqli_query($conn, $query)) {

        $student_id = mysqli_insert_id($conn);

        $address_query = "INSERT INTO addresses
        (student_id, address, city, state, country)
        VALUES
        ('$student_id', '$address', '$city', '$state', '$country')";

        if (mysqli_query($conn, $address_query)) {

            header("Location: records.php");
            exit();

        } else {

            $error = "Address save failed: " . mysqli_error($conn);
        }

    } else {

        $error = "Student registration failed: " . mysqli_error($conn);
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
        <label>City</label>
        <input type="text" name="city" placeholder="Enter City" required>

        <label>State</label>
        <input type="text" name="state" placeholder="Enter State" required>

        <label>Country</label>
        <input type="text" name="country" placeholder="Enter Country" required>

       <label>Student Type</label>
       <select name="student_type" required>
           <option value="">Select Student Type</option>
           <option value="School">School</option>
           <option value="College">College</option>
       </select>

       <div id="school-class">
    <label>Class</label>

    <select name="class_name">
              <option value="">Select Class</option>
        <option value="Nursery">Nursery</option>
        <option value="LKG">LKG</option>
        <option value="UKG">UKG</option>
        <option value="1">Class 1</option>
        <option value="2">Class 2</option>
        <option value="3">Class 3</option>
        <option value="4">Class 4</option>
        <option value="5">Class 5</option>
        <option value="6">Class 6</option>
        <option value="7">Class 7</option>
        <option value="8">Class 8</option>
        <option value="9">Class 9</option>
        <option value="10">Class 10</option>
        <option value="11">Class 11</option>
        <option value="12">Class 12</option>
    </select>
</div>

<div id="college-course">
    <label>Course</label>

    <select name="course_id">
        <option value="">Select Course</option>

        <?php while ($course = mysqli_fetch_assoc($course_result)) { ?>
            <option value="<?php echo $course['id']; ?>">
                <?php echo $course['course_name'] . " - " . $course['course_code']; ?>
            </option>
        <?php } ?>

    </select>
</div>

        <button type="submit" name="register">
            Register Student
        </button>

    </form>
         
</div>
  <a href="../dashboard/dashboard.php" class="back-btn" >Back</a>
</body>
</html>