<?php
include('connect.php');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security
    //check user exists or not
    $check = "SELECT * FROM `admin` WHERE email='$email'";
    $result = mysqli_query($conn, $check);

    if (mysqli_num_rows($result) > 0) {
        // Phone number and email  already exists
        echo "<script>alert('User already exists.')</script>";
    } else {
        // Proceed with the register
        $query = "INSERT INTO `admin`(`username`, `email` , `password`) VALUES ('$username', '$email', '$hashedPassword')";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('User registered successfully.')</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>admin Registration</title>
    </head>
    <body>
        <h2>admin  Registration</h2>
        <form method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" required><br><br>
            <label for="email">email:</label>
            <input type="email" name="email" required><br><br>
            <label for="password">Password:</label>
            <input type="password" name="password" required><br><br>
            <button type="submit" name="submit">Register</button>
        </form>
    </body>
</html>
