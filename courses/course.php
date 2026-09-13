<?php
session_start();
include "../config/database.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

if (isset($_POST['add_course'])) {

    $course_name = $_POST['course_name'];
    $course_code = $_POST['course_code'];
    $course_type = $_POST['course_type'];
    $department = $_POST['department'];
    $duration = $_POST['duration'];
    $fees = $_POST['fees'];

    $query = "INSERT INTO courses 
              (course_name, course_code, course_type, department, duration, fees)
              VALUES 
              ('$course_name', '$course_code', '$course_type', '$department', '$duration', '$fees')";

    mysqli_query($conn, $query);

    header("Location: course.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM courses ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Course Management</title>
    <link rel="stylesheet" href="../assets/css/course.css">
</head>

<body>

<div class="container">

    <h1>Course Management</h1>

    <form method="POST">

        <label>Course Name</label>
        <input type="text" name="course_name" required>

        <label>Course Code</label>
        <input type="text" name="course_code" required>

        <label>Course Type</label>
        <select name="course_type" required>
            <option value="">Select Course Type</option>
            <option value="UG">UG</option>
            <option value="PG">PG</option>
            <option value="Diploma">Diploma</option>
            <option value="Certificate">Certificate</option>
        </select>

        <label>Department</label>
        <input type="text" name="department" required>

        <label>Duration</label>
        <input type="text" name="duration" placeholder="e.g. 3 Years" required>

        <label> Semester Fees</label>
        <input type="number" name="fees" step="0.01" required>

        <button type="submit" name="add_course">Add Course</button>

    </form>

    <h2>Course List</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Course Name</th>
            <th>Course Code</th>
            <th>Type</th>
            <th>Department</th>
            <th>Duration</th>
            <th>Semester Fees</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>

        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['course_name']; ?></td>
            <td><?php echo $row['course_code']; ?></td>
            <td><?php echo $row['course_type']; ?></td>
            <td><?php echo $row['department']; ?></td>
            <td><?php echo $row['duration']; ?></td>
            <td>₹<?php echo $row['fees']; ?></td>
        </tr>

        <?php } ?>

    </table>

</div>
     <a href="../dashboard/dashboard.php" class="back-btn">Back</a>
</body>
</html>