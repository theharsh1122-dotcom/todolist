<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit();
}

include "../config/database.php";

$result = mysqli_query($conn, "SELECT * FROM tasks ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>To-Do List</title>
   <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    
    <div class="top-bar">
         <a href="../auth/logout.php" class="logout-btn">Logout</a>
        <a href="../users/users.php" class="users-btn">View Users</a>
        <a href="../dashboard/dashboard.php" class="dashboard-btn">Dashboard</a>
    </div>
<div class="container">

<h1> Todo List</h1>


<form action="../todos/addd.php" method="POST">
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
               href="../todos/completed.php?id=<?php echo $row['id']; ?>">
                Complete
            </a>
    

        <?php } ?>
        <a class="edit-btn" href="../todos/edit.php?id=<?php echo $row['id']; ?>">Edit</a>

        <a class="delete-btn"href="../todos/deleted.php?id=<?php echo $row['id']; ?>">Delete </a>
    </span>

</p>
<?php } ?>
</div>
</body>
</html>