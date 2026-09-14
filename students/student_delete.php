<?php

session_start();

include "../config/database.php";

if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit();
}

if (isset($_GET['form_no'])) {

    $form_no = $_GET['form_no'];

    $query = "DELETE FROM students WHERE form_no=$form_no";

    if (mysqli_query($conn, $query)) {
        header("Location: records.php");
        exit();
    } else {
        echo "Student delete failed!";
    }
}
?>