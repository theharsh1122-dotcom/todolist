<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "database.php";

$result = mysqli_query($conn, "SELECT * FROM tasks ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>To-Do List</title>
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
    

        <?php } ?>
        <a class="edit-btn" href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>

        <a class="delete-btn"href="deleted.php?id=<?php echo $row['id']; ?>">Delete </a>
    </span>

</p>
<?php } ?>
</div>
</body>
</html>