<?php
include 'connect.php';
error_reporting(0);
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php');
    exit;
    // Make sure to exit to prevent further execution
    // if (isset($_COOKIE['user_email'])) {
//     $user_email = $_COOKIE['user_email'];
// }
}

$id = $_SESSION['id'];
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Foodie</title>
        <link rel="stylesheet" href="home.css">
    </head>
    <body>  
        <div class="navbar">
            <ul>
                <li><a>Prayosha</a></li>
                <li><a href="#home">Home</a></li>
                <li><a href="#news">News</a></li>
                <li><a href="#contact">Contact</a></li>
                <li style="float:right"><a class="active" href="logout.php">Logout</a></li>
                <li style="float:right"><a class="add-to-cart" href="customerprofile.php"></i> my profile</a></li>
            </ul>
            <div style="clear: both;"></div> <!-- Clear the float -->
        </div>
        <section class="home">
            <div class="content">
                <h4>Heloo foodie.</h4>
                <p>“Food is really and truly the most effective medicine.” – Joel Fuhrman.</p>
                <!-- Add the "Order" button to the navigation menu -->
                <a class="order-button">Order Now</a>
            </div>
        </section>
        <!-- <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $user_email; ?>" required>
</div> -->


        <?php
        include ("footer.php");
        ?>
    </body>
</html>
