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
<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <input type="checkbox" id="todo-menu-toggle">

<label for="todo-menu-toggle" class="todo-menu-button">☰</label>

<div class="todo-side-menu">
    <h2>Todo List</h2>

    <a href="../dashboard/dashboard.php">Dashboard</a>
    <a href="../users/users.php">All users</a>
    <a href="todo.php">Todo List</a>
    <a href="../profile/profile.php">My Profile</a>
</div>

<details class="todo-profile-menu">
    <summary class="todo-profile-button">

        <?php
        $user_id = $_SESSION['user_id'];

        $user_result = mysqli_query(
            $conn,
            "SELECT first_name, profile_photo FROM users WHERE id=$user_id"
        );

        $user = mysqli_fetch_assoc($user_result);
        ?>

        <?php if (!empty($user['profile_photo'])) { ?>

            <img src="../uploads/<?php echo htmlspecialchars($user['profile_photo']); ?>">

        <?php } else { ?>

            <div class="todo-default-avatar">
                <?php echo strtoupper(substr($user['first_name'], 0, 1)); ?>
            </div>

        <?php } ?>

        <span><?php echo htmlspecialchars($user['first_name']); ?></span>

    </summary>

    <div class="todo-profile-dropdown">
        <a href="../profile/profile.php">Edit Profile</a>
        <a href="../auth/logout.php">Logout</a>
    </div>
</details>
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