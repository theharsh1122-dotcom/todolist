<?php
include "database.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $result = mysqli_query($conn, "SELECT * FROM tasks WHERE id=$id");
    $task = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {

    $id = $_POST['id'];
    $task = $_POST['task'];

    $query = "UPDATE tasks SET task='$task' WHERE id=$id";

    if (mysqli_query($conn, $query)) {
        header("Location: todo.php");
        exit();
    } else {
        echo "Update failed: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link rel="stylesheet" href="edit.css">
</head>
<body>
    <h2>Edit Task</h2>
    <form method="POST">

    <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
    <input type="text" name="task" value="<?php echo htmlspecialchars($task['task']);?>" required>
    <button type="Submit" name="update">Update Task</button>
    </form>
</body>
</html>