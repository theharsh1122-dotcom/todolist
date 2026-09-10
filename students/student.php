<?php

session_start();

include "../config/database.php";

if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit();
}

$query = "SELECT * FROM students ORDER BY form_no DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Database Error: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Students</title>

    <link rel="stylesheet" href="../assets/css/student.css">
</head>

<body>

<div class="student-page">

    <div class="student-header">
        <h1>Student Records</h1>
    </div>

    <div class="table-container">
        <table>
           <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Form No</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Father Name</th>
                    <th>Mother Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Student Type</th>
                    <th>Class / Course</th>
                    <th>Created At</th>
                </tr>
            </thead>

            <tbody>

            <?php if (mysqli_num_rows($result) > 0) { ?>

                <?php
                $sr_no = 1;

                while ($row = mysqli_fetch_assoc($result)) {
                ?>

                    <tr>

                        <td><?php echo $sr_no++; ?></td>

                        <td><?php echo htmlspecialchars($row['form_no']); ?></td>

                        <td><?php echo htmlspecialchars($row['first_name']); ?></td>

                        <td><?php echo htmlspecialchars($row['last_name']); ?></td>

                        <td><?php echo htmlspecialchars($row['father_name']); ?></td>

                        <td><?php echo htmlspecialchars($row['mother_name']); ?></td>

                        <td><?php echo htmlspecialchars($row['email']); ?></td>

                        <td><?php echo htmlspecialchars($row['phone']); ?></td>

                        <td><?php echo htmlspecialchars($row['date_of_birth']); ?></td>

                        <td><?php echo htmlspecialchars($row['gender']); ?></td>

                        <td><?php echo htmlspecialchars($row['address']); ?></td>

                        <td><?php echo htmlspecialchars($row['student_type']); ?></td>

                        <td><?php echo htmlspecialchars($row['class_course']); ?></td>

                        <td><?php echo htmlspecialchars($row['created_at']); ?></td>

                    </tr>

                <?php } ?>

            <?php } else { ?>

                <tr>
                    <td colspan="16" class="no-data">
                        No students found
                    </td>
                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</body>

</html>