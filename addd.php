<?php

include "database.php";

if (isset($_POST['task'])) {

    $task = $_POST['task'];
<<<<<<< HEAD
     mysqli_query($conn,"INSERT INTO tasks (task) VALUES ('$task')");
}

header("Location: todo.php");
exit();
=======

    mysqli_query(
        $conn,
        "INSERT INTO tasks (task) VALUES ('$task')"
    );
}

header("Location: todo.php");
exit;
>>>>>>> 8ecd669587ab1381eeb278c21d72d42763fa0744

?>