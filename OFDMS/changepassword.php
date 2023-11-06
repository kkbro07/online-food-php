<?php
include 'connect.php';
session_start();
// Check if the user is not logged in, then redirect to header.php
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit(); // Ensure script execution stops after redirection
}

if (isset($_POST['changePassword'])) {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if the new password and confirmation match
    if ($newPassword !== $confirmPassword) {
        echo "<script>alert('New Password and Confirm Password do not match.')</script>";
    } else {
        // Get the user's email from the session
        $email = $_SESSION['email'];

        // Check if the user exists in the database
        $query = "SELECT * FROM user WHERE email='$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row['pwd'];

            // Verify the current password
            if (password_verify($currentPassword, $hashedPassword)) {
                // Hash the new password for security
                $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                // Update the user's password in the database
                $updateQuery = "UPDATE user SET pwd='$newHashedPassword' WHERE email='$email'";
                if (mysqli_query($conn, $updateQuery)) {
                    echo "<script>alert('Password changed successfully.')</script>";
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            } else {
                echo "<script>alert('Current Password is incorrect.')</script>";
            }
        } else {
            echo '<p style="color: red;">User does not exist.</p>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>changePassword</title>
        <link rel="stylesheet" href="changepassword.css">

    </head>
    <body>
        <div class="content">
            <h2>Change Password</h2>
            <form method="post" action="#">
                <div class="form-group">
                    <label for="currentPassword">Current Password:</label>
                    <input type="password" id="currentPassword" name="currentPassword" required>
                </div>
                <div class="form-group">
                    <label for="newPassword">New Password:</label>
                    <input type="password" id="newPassword" name="newPassword" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm New Password:</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" required>
                </div>
                <button type="submit" name="changePassword">Change Password</button>
            </form>
        </div>
    </body>
</html>