<?php
include "database.php";

$sql = "SELECT id, first_name, last_name, email, username, phone, gender
        FROM users
        ORDER BY id DESC";

$result = mysqli_query($conn, $sql);
$total_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users");
$total = mysqli_fetch_assoc($total_result)['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Users</title>
    <link rel="stylesheet" href="users.css">
</head>

<body>

<div class="users-container">

    <h2>All Registered Users</h2>
    <p class="users">Toatal Users: <strong><?php echo $total; ?></strong></p>

    <table>

        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

        <?php
        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {
        ?>

            <tr>
                <td><?php echo $row['id']; ?></td>

                <td>
                    <?php echo htmlspecialchars($row['first_name']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row['last_name']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row['email']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row['username']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row['phone']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row['gender']); ?>
                </td>

                <td>
                    <a href="user_edit.php?id=<?php echo $row['id']; ?>">✏️</a>
                    <a href="user_delete.php?id=<?php echo $row['id']; ?>">🗑</a>
                </td>
            </tr>

        <?php
            }

        } else {
        ?>

            <tr>
                <td colspan="7">No users found.</td>
            </tr>

        <?php } ?>

        </tbody>

    </table>

    <a href="todo.php" class="back-btn">Back</a>

</div>

</body>
</html>