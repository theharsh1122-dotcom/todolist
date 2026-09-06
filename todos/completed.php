<?php
include "../config/database.php";

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    mysqli_query($conn, "UPDATE tasks SET status='completed' WHERE id=$id");

    header("Location: ../todos/todo.php");
    exit;
}
?>