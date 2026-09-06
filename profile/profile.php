<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit();
}

include "../config/database.php";

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn, "SELECT * FROM users WHERE id=$user_id");

if (mysqli_num_rows($result) == 0) {
    echo "User not found!";
    exit();
}

$user = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];

    $profile_photo = $user['profile_photo'];

    if (!empty($_FILES['profile_photo']['name'])) {

        $file_name = $_FILES['profile_photo']['name'];
        $tmp_name = $_FILES['profile_photo']['tmp_name'];

        $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        $allowed = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($extension, $allowed)) {

            $new_name = "profile_" . $user_id . "_" . time() . "." . $extension;

            $upload_path = "../uploads/" . $new_name;

            if (move_uploaded_file($tmp_name, $upload_path)) {
                $profile_photo = $new_name;
            }
        }
    }

    $query = "UPDATE users SET
        first_name='$first_name',
        last_name='$last_name',
        email='$email',
        phone='$phone',
        gender='$gender',
        profile_photo='$profile_photo'
        WHERE id=$user_id";

    if (mysqli_query($conn, $query)) {
        header("Location: profile.php");
        exit();
    } else {
        echo "Profile update failed: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    <link rel="stylesheet" href="../assets/profile.css">
</head>

<body>

<div class="profile-container">

    <h1>My Profile</h1>

    <div class="profile-image">
        <?php if (!empty($user['profile_photo'])) { ?>
            <img src="../uploads/<?php echo $user['profile_photo']; ?>">
        <?php } else { ?>
            <div class="default-photo">
                <?php echo strtoupper(substr($user['first_name'], 0, 1)); ?>
            </div>
        <?php } ?>
    </div>

    <form method="POST" enctype="multipart/form-data">

        <label>Profile Photo</label>
        <input type="file" name="profile_photo" accept="image/*">

        <label>First Name</label>
        <input type="text" name="first_name" value="<?php echo $user['first_name']; ?>" required>

        <label>Last Name</label>
        <input type="text" name="last_name" value="<?php echo $user['last_name']; ?>" required>

        <label>Email</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required>

        <label>Username</label>
        <input type="text" value="<?php echo $user['username']; ?>" disabled>

        <label>Phone</label>
        <input type="text" name="phone" value="<?php echo $user['phone']; ?>">

        <label>Gender</label>
        <select name="gender" required>
            <option value="Male" <?php if ($user['gender'] == "Male") echo "selected"; ?>>Male</option>
            <option value="Female" <?php if ($user['gender'] == "Female") echo "selected"; ?>>Female</option>
            <option value="Other" <?php if ($user['gender'] == "Other") echo "selected"; ?>>Other</option>
        </select>

        <label>User Type</label>
        <input type="text" value="<?php echo ucfirst($user['user_type']); ?>" disabled>

        <button type="submit" name="update">Update Profile</button>

    </form>

    <a href="../dashboard/dashboard.php">Back to Dashboard</a>

</div>

</body>
</html>