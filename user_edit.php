
<?php
include "database.php";

if (!isset($_GET['id'])) {
    header("Location: users.php");
    exit();
}

$id = $_GET['id'];

/* User ki current details lana */
$result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");

if (mysqli_num_rows($result) == 0) {
    echo "User not found!";
    exit();
}

$user = mysqli_fetch_assoc($result);


/* Update User */
if (isset($_POST['update'])) {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $gender = $_POST['gender'];

    $query = "UPDATE users SET
        first_name='$first_name',
        last_name='$last_name',
        email='$email',
        phone='$phone',
        username='$username',
        gender='$gender'
        WHERE id=$id";

    if (mysqli_query($conn, $query)) {

        header("Location: users.php");
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

    <title>Edit User</title>

    <link rel="stylesheet" href="user_edit.css">
</head>

<body>

<div class="edit-container">

    <h2>Edit User</h2>

    <form method="POST">

        <label>First Name</label>
        <input
            type="text"
            name="first_name"
            value="<?php echo htmlspecialchars($user['first_name']); ?>"
            required
        >

        <label>Last Name</label>
        <input
            type="text"
            name="last_name"
            value="<?php echo htmlspecialchars($user['last_name']); ?>"
            required
        >

        <label>Email</label>
        <input
            type="email"
            name="email"
            value="<?php echo htmlspecialchars($user['email']); ?>"
            required
        >

        <label>Phone</label>
        <input
            type="text"
            name="phone"
            value="<?php echo htmlspecialchars($user['phone']); ?>"
            required
        >

        <label>Username</label>
        <input
            type="text"
            name="username"
            value="<?php echo htmlspecialchars($user['username']); ?>"
            required
        >

        <label>Gender</label>

        <div class="gender-box">

            <label>
                <input
                    type="radio"
                    name="gender"
                    value="Male"
                    <?php if ($user['gender'] == "Male") echo "checked"; ?>
                >
                Male
            </label>

            <label>
                <input
                    type="radio"
                    name="gender"
                    value="Female"
                    <?php if ($user['gender'] == "Female") echo "checked"; ?>
                >
                Female
            </label>

            <label>
                <input
                    type="radio"
                    name="gender"
                    value="Other"
                    <?php if ($user['gender'] == "Other") echo "checked"; ?>
                >
                Other
            </label>

        </div>

        <button type="submit" name="update">
            Update User
        </button>

    </form>

    <a href="users.php" class="back-btn">
        Back
    </a>

</div>

</body>
</html>
