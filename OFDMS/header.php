<?php
include 'connect.php';
session_start();
?>
<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $cno = $_POST['cno'];
    $pwd = $_POST['pwd'];
    $cpwd = $_POST['cpwd'];

    if ($pwd !== $cpwd) {
        // Password and Confirm Password do not match
        echo "<script>alert('Password and Confirm Password do not match.')</script>";
    } else {

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $hashedPassword = password_hash($pwd, PASSWORD_DEFAULT); // Hash the password for security
        //check user exists or not
        $check = "SELECT * FROM user WHERE cno='$cno' AND email='$email'";
        $result = mysqli_query($conn, $check);

        if (mysqli_num_rows($result) > 0) {
            // Phone number and email  already exists
            echo "<script>alert('User already exists.')</script>";
        } else {
            // Proceed with the register
            $query = "INSERT INTO `user`(`name`, `email`, `cno`, `pwd`) VALUES ('$name', '$email', '$cno', '$hashedPassword')";

            if (mysqli_query($conn, $query)) {
                echo "<script>alert('User registered successfully.')</script>";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }

        mysqli_close($conn);
    }
}
?>
<?php
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    // Check if the user exists in the database
    $query = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Get the user's hashed password from the database
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['pwd'];

        // Verify the password
        if (password_verify($pwd, $hashedPassword)) {
            // The password is correct, so log the user in
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;

            // Redirect the user to the home page
            header('Location: home.php');
        } else {
            // The password is incorrect, so display an error message
            echo '<p style="color: red;">Incorrect password.</p>';
        }
    } else {
        // The user does not exist, so display an error message
        echo '<p style="color: red;">User does not exist.</p>';
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Foodie</title>
        <link rel="stylesheet" href="header.css">
    </head>
    <body>  
        <div class="navbar">
            <ul>
                <li><a>Prayosha</a></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="menu.php">menu</a></li> <!--Added "Pizza" link with an anchor to the pizza section -->
                <li><a href="#">order Now</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li style="float:right"><a class="active" href="javascript:void(0);" onclick="openPopuplogin(), closePopupsignup()">Login</a></li>
                <li style="float:right"><a class="active" href="javascript:void(0);" onclick="openPopupsignup(), closePopuplogin()">Sign up</a></li>
            </ul>
            <div style="clear: both;"></div> <!-- Clear the float -->
        </div>

        <!-- for sign in pop up -->

        <div class="popup" id="signupPopup">
            <div class="signup-container">
                <h2>Sign Up</h2>
                <!-- <form id="signupForm"> -->
                <form id="signupForm" method="post"  onsubmit="return validateForm()">
                    <div class="form-group ">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" placeholder="Enter Name"required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" placeholder="Enter Email id"required>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact Number:</label>
                        <input type="tel" id="contact" name="cno" pattern="[0-9]{10}" placeholder="Enter 10-digit contact number" required>
                    </div>
                    <div class="form-group"> 
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="pwd"  placeholder="Enter Password"required>
                    </div>
                    <div class="form-group">
                        <label for="cpassword">confirm Password:</label>
                        <input type="password" id="cpassword" name="cpwd"  placeholder="Enter Password"required>
                    </div>
                    <button type="submit" name="submit">Sign Up</button>
                    <button onclick="closePopupsignup()">Close</button>
                    <div class="container signup">
                        <p>Already have an account? <a href="#" onclick="openPopuplogin(), closePopupsignup()">Login?</a></p>
                    </div>
                </form>
            </div>      
        </div>

        <!-- for login pop up -->
        <div class="popup" id="loginPopup">
            <div class="login-container">
                <h2>Login</h2>
                <form id="loginForm" method="post">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="pwd" required>
                    </div>
                    <button type="submit" name="login" value="Login">Login</button>
                    <button onclick="closePopuplogin()">Close</button>
                    <div class="container login">
                        <p>Create an account? <a href="#" onclick="openPopupsignup(), closePopuplogin()">Sign up?</a></p>
                        <p>Forgot password? <a href="#" onclick="openForgotPassword(), closePopuplogin()">Reset Password?</a></p>
                    </div>
                </form>
            </div>
        </div>
        <!-- Forgot password pop up -->
        <div class="popup" id="forgotPasswordPopup">
            <div class="forgot-password-container">
                <h2>Forgot Password</h2>
                <form id="forgotPasswordForm" method="post">
                    <div class="form-group">
                        <label for="forgotPasswordEmail">Email:</label>
                        <input type="email" id="forgotPasswordEmail" name="forgotPasswordEmail" required>
                    </div>
                    <button type="submit" name="forgotPassword" value="Forgot Password">Reset Password</button>
                    <button onclick="closeForgotPassword()">Close</button>
                    <div class="container login">
                        <p>Remember your password? <a href="#" onclick="openPopuplogin(), closeForgotPassword()">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
        <script src="js/script.js"></script>
    </body>
</html>
