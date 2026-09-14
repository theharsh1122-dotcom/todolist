<?php

session_start();

include "../config/database.php";

if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit();
}

if (!isset($_GET['form_no'])) {
    header("Location: records.php");
    exit();
}

$form_no = $_GET['form_no'];

$result = mysqli_query($conn, "SELECT * FROM students WHERE form_no=$form_no");

if (!$result || mysqli_num_rows($result) == 0) {
    echo "Student not found!";
    exit();
}

$student = mysqli_fetch_assoc($result);

$course_result = mysqli_query($conn, "SELECT id, course_name, course_code FROM courses ORDER BY course_name ASC");

if (isset($_POST['update'])) {

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

    if ($student_type == "School") {

        $class_course = $_POST['class_name'];

    } else {

        $course_id = $_POST['course_id'];

        $course_query = mysqli_query(
            $conn,
            "SELECT course_name, course_code FROM courses WHERE id=$course_id"
        );

        $course_data = mysqli_fetch_assoc($course_query);

        $class_course = $course_data['course_name'] . " - " . $course_data['course_code'];
    }

    $query = "UPDATE students SET
        first_name='$first_name',
        last_name='$last_name',
        father_name='$father_name',
        mother_name='$mother_name',
        email='$email',
        phone='$phone',
        date_of_birth='$date_of_birth',
        gender='$gender',
        address='$address',
        student_type='$student_type',
        class_course='$class_course'
        WHERE form_no=$form_no";

    if (mysqli_query($conn, $query)) {

        header("Location: records.php");
        exit();

    } else {

        $error = "Student update failed!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Student</title>

    <link rel="stylesheet" href="../assets/css/student_edit.css">

</head>

<body>

<div class="student-container">

    <h1>Edit Student</h1>

    <?php
    if (isset($error)) {
        echo "<p class='error'>$error</p>";
    }
    ?>

    <form method="POST">

        <label>First Name</label>

        <input
            type="text"
            name="first_name"
            value="<?php echo htmlspecialchars($student['first_name']); ?>"
            required
        >

        <label>Last Name</label>

        <input
            type="text"
            name="last_name"
            value="<?php echo htmlspecialchars($student['last_name']); ?>"
            required
        >

        <label>Father Name</label>

        <input
            type="text"
            name="father_name"
            value="<?php echo htmlspecialchars($student['father_name']); ?>"
            required
        >

        <label>Mother Name</label>

        <input
            type="text"
            name="mother_name"
            value="<?php echo htmlspecialchars($student['mother_name']); ?>"
            required
        >

        <label>Email</label>

        <input
            type="email"
            name="email"
            value="<?php echo htmlspecialchars($student['email']); ?>"
        >

        <label>Phone</label>

        <input
            type="tel"
            name="phone"
            value="<?php echo htmlspecialchars($student['phone']); ?>"
            required
        >

        <label>Date of Birth</label>

        <input
            type="date"
            name="date_of_birth"
            value="<?php echo htmlspecialchars($student['date_of_birth']); ?>"
            required
        >

        <label>Gender</label>

        <div class="gender">

            <input
                type="radio"
                name="gender"
                value="Male"
                <?php if ($student['gender'] == "Male") echo "checked"; ?>
                required
            >
            Male

            <input
                type="radio"
                name="gender"
                value="Female"
                <?php if ($student['gender'] == "Female") echo "checked"; ?>
            >
            Female

            <input
                type="radio"
                name="gender"
                value="Other"
                <?php if ($student['gender'] == "Other") echo "checked"; ?>
            >
            Other

        </div>

        <label>Address</label>

        <textarea name="address" required><?php echo htmlspecialchars($student['address']); ?></textarea>

        <label>Student Type</label>

        <select name="student_type" required>

            <option value="">Select Student Type</option>

            <option
                value="School"
                <?php if ($student['student_type'] == "School") echo "selected"; ?>
            >
                School
            </option>

            <option
                value="College"
                <?php if ($student['student_type'] == "College") echo "selected"; ?>
            >
                College
            </option>

        </select>

        <label>Class</label>

        <select name="class_name">

            <option value="">Select Class</option>

            <option value="Nursery"
                <?php if ($student['class_course'] == "Nursery") echo "selected"; ?>>
                Nursery
            </option>

            <option value="LKG"
                <?php if ($student['class_course'] == "LKG") echo "selected"; ?>>
                LKG
            </option>

            <option value="UKG"
                <?php if ($student['class_course'] == "UKG") echo "selected"; ?>>
                UKG
            </option>

            <option value="1"
                <?php if ($student['class_course'] == "1") echo "selected"; ?>>
                Class 1
            </option>

            <option value="2"
                <?php if ($student['class_course'] == "2") echo "selected"; ?>>
                Class 2
            </option>

            <option value="3"
                <?php if ($student['class_course'] == "3") echo "selected"; ?>>
                Class 3
            </option>

            <option value="4"
                <?php if ($student['class_course'] == "4") echo "selected"; ?>>
                Class 4
            </option>

            <option value="5"
                <?php if ($student['class_course'] == "5") echo "selected"; ?>>
                Class 5
            </option>

            <option value="6"
                <?php if ($student['class_course'] == "6") echo "selected"; ?>>
                Class 6
            </option>

            <option value="7"
                <?php if ($student['class_course'] == "7") echo "selected"; ?>>
                Class 7
            </option>

            <option value="8"
                <?php if ($student['class_course'] == "8") echo "selected"; ?>>
                Class 8
            </option>

            <option value="9"
                <?php if ($student['class_course'] == "9") echo "selected"; ?>>
                Class 9
            </option>

            <option value="10"
                <?php if ($student['class_course'] == "10") echo "selected"; ?>>
                Class 10
            </option>

            <option value="11"
                <?php if ($student['class_course'] == "11") echo "selected"; ?>>
                Class 11
            </option>

            <option value="12"
                <?php if ($student['class_course'] == "12") echo "selected"; ?>>
                Class 12
            </option>

        </select>

        <label>Course</label>

        <select name="course_id">

            <option value="">Select Course</option>

            <?php while ($course = mysqli_fetch_assoc($course_result)) { ?>

                <option value="<?php echo $course['id']; ?>">

                    <?php
                    echo $course['course_name'] . " - " . $course['course_code'];
                    ?>

                </option>

            <?php } ?>

        </select>

        <button type="submit" name="update">
            Update Student
        </button>

    </form>

</div>

<a href="records.php" class="back-btn">Back</a>

</body>

</html>