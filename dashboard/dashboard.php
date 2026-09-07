<?php
session_start();
include "../config/database.php";

if (!isset ($_SESSION['username'])){
    header("Location: ../auth/login.php");
exit();
}
$user_type = $_SESSION['user_type'];

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

    <link rel="stylesheet" href="../assets/dashboard.css">
</head>

<body>

<input type="checkbox" id="menu-toggle">

<label for="menu-toggle" class="menu-button">☰</label>

<div class="side-menu">
    <h2>Dashboard</h2>
    <a href="../todos/todo.php">Todo List</a>

    <?php if ($_SESSION['user_type'] === 'admin') { ?>
        <a href="../users/users.php">Users</a>
    <?php } ?>

</div>
    <div class="dashboard-container">

        <div class="dashboard-header">

            <h1>Dashboard</h1>

        </div>
        <div class="date">
               <p>
                <?php echo date("l, F d"); ?>
            </p>
        </div>
        <details class="profile-menu">

    <summary class="profile-button">

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

            <div class="default-avatar">
                <?php echo strtoupper(substr($user['first_name'], 0, 1)); ?>
            </div>

        <?php } ?>

        <span><?php echo htmlspecialchars($user['first_name']); ?></span>

    </summary>

    <div class="profile-dropdown">

        <a href="../profile/profile.php">Edit Profile</a>

        <a href="../auth/logout.php">Logout</a>

    </div>

</details>
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

        </div>

    </div>

</body>

</html>