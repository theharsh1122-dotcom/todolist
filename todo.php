<?php
session_start();
<<<<<<< HEAD

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

=======
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}
>>>>>>> 8ecd669587ab1381eeb278c21d72d42763fa0744
include "database.php";

$result = mysqli_query($conn, "SELECT * FROM tasks ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>To-Do List</title>
<<<<<<< HEAD
    <link rel="icon" type="image/png" href="assets/todo.png">
    <link rel="stylesheet" href="style.css?v=2">
</head>

<body>
    
    <div class="top-bar">
         <a href="logout.php" class="logout-btn">Logout</a>
        <a href="users.php" class="users-btn">View Users</a>
        <a href="dashboard.php" class="dashboard-btn">Dashboard</a>
    </div>
<div class="container">

<h1> Todo List</h1>

=======
    <link rel="stylesheet" href="style.css">
</head>

<body>
<div class="container">
<h1> Todo List</h1>
<a href="logout.php" class="logout-btn">Logout</a>
>>>>>>> 8ecd669587ab1381eeb278c21d72d42763fa0744

<form action="addd.php" method="POST">
    <input type="text" name="task" placeholder="Enter your task" required>
    <button type="submit">Add Task</button>
</form>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>

<p class="<?php echo $row['status'] == 'completed' ? 'completed-task' : ''; ?>">

    <?php echo htmlspecialchars($row['task']); ?>

    <span class="actions">

        <?php if ($row['status'] == 'completed') { ?>

            <span class="completed-text">✓ Completed</span>

        <?php } else { ?>

            <a class="complete-btn"
               href="completed.php?id=<?php echo $row['id']; ?>">
                Complete
            </a>
<<<<<<< HEAD
    

        <?php } ?>
        <a class="edit-btn" href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>

        <a class="delete-btn"href="deleted.php?id=<?php echo $row['id']; ?>">Delete </a>
=======

        <?php } ?>

        <a class="delete-btn"
           href="deleted.php?id=<?php echo $row['id']; ?>">
            Delete
        </a>

>>>>>>> 8ecd669587ab1381eeb278c21d72d42763fa0744
    </span>

</p>
<?php } ?>
</div>
</body>
</html>