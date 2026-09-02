<?php

include "database.php";

if (isset($_POST['task'])) {

    $task = $_POST['task'];
     mysqli_query($conn,"INSERT INTO tasks (task) VALUES ('$task')");
}

header("Location: todo.php");
exit();

?>