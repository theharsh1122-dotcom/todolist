<?php
include "../config/database.php";

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = "DELETE FROM users WHERE id=$id";

    if (mysqli_query($conn, $query)) {
        header("Location: /users/users.php");
        exit();
    } else {
        echo "Delete failed: " . mysqli_error($conn);
    }
}
?>