<?php
include 'connect.php';
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the user exists in the database
    $query = "SELECT * FROM `admin` WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Get the user's hashed password from the database
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];
        $_SESSION['admin_id'] = $row['id'];

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // The password is correct, so log the user in
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;

            // Redirect the user to the home page
            header('Location: adminpanel.php');
        } else {
            // The password is incorrect, so display an error message
            echo '<p style="color: red;">Incorrect password.</p>';
        }
    } else {
        // The user does not exist, so display an error message
        echo '<p style="color: red;">User does not exist.</p>';
    }
}
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ADMIN LOGIN</title>
        <link rel="stylesheet" href="admin.css">
    </head>
    <body>

        <div class="container">
            <img src="photo/admin.jpg" alt="Logo">
            <h1>Login</h1>
            <form method="post">
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
                <button type="submit" name="login">Login</button>
            </form>
        </div>

    </body>
</html>