<?php
session_start();
include "database.php";

$user_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users");
$user_data = mysqli_fetch_assoc($user_result);
$total_users = $user_data['total'];

$todo_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tasks");
$todo_data = mysqli_fetch_assoc($todo_result);
$total_todos = $todo_data['total'];

$completed_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tasks WHERE status='completed'");
$completed_data = mysqli_fetch_assoc($completed_result);
$completed_todos = $completed_data['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard</title>

    <link rel="stylesheet" href="dashboard.css">
</head>

<body>

    <div class="dashboard-container">

        <div class="dashboard-header">

            <h1>Dashboard</h1>

            <p>
                <?php echo date("l, F d"); ?>
            </p>

        </div>

<div class="stats-container">

    <div class="stat-box">

        <div>
            <h3>Total users</h3>
            <h2><?php echo $total_users; ?></h2>
            <span>↑ New users</span>
        </div>

    </div>

    <div class="stat-box">

        <div>
            <h3>Total to-dos</h3>
            <h2><?php echo $total_todos; ?></h2>
            <span><?php echo $completed_todos; ?> completed today👌</span>
        </div>
        
    </div>

</div>

<div class="dashboard-buttons">

    <a href="todo.php" class="dashboard-btn">
        Todo List
    </a>

    <a href="users.php" class="dashboard-btn">
        All Users
    </a>

    <a href="logout.php" class="logout-btn">
        Logout
    </a>

</div>

        </div>

    </div>

</body>

</html>