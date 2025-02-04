<?php
include 'connect.php';
error_reporting(0);
session_start();
$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location: admin.php');
}
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ADMIN PANEL</title>

        <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- custom admin css file link  -->
<link rel="stylesheet" href="css/admin_style.css">
    </head>
    <body>
        <?php include("admin_header.php");
        ?>


        <section class="dashboard">

            <h1 class="title">dashboard</h1>

            <div class="box-container">

                <div class="box">
                    <?php
                    $total_pendings = 0;
                    $select_pending = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'pending'") or die('query failed');
                    if (mysqli_num_rows($select_pending) > 0) {
                        while ($fetch_pendings = mysqli_fetch_assoc($select_pending)) {
                            $total_price = $fetch_pendings['total_price'];
                            $total_pendings += $total_price;
                        };
                    };
                    ?>
                    <h3><?php echo $total_pendings; ?>/-</h3>
                    <p>Total Pendings</p>
                </div>

                <div class="box">
                    <?php
                    $total_completed = 0;
                    $select_completed = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'completed'") or die('query failed');
                    if (mysqli_num_rows($select_completed) > 0) {
                        while ($fetch_completed = mysqli_fetch_assoc($select_completed)) {
                            $total_price = $fetch_completed['total_price'];
                            $total_completed += $total_price;
                        };
                    };
                    ?>
                    <h3><?php echo $total_completed; ?>/-</h3>
                    <p>Completed Payments</p>
                </div>

                <div class="box">
                    <?php
                    $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
                    $number_of_orders = mysqli_num_rows($select_orders);
                    ?>
                    <h3><?php echo $number_of_orders; ?></h3>
                    <p>Order placed</p>
                </div>

                <div class="box">
                    <?php
                    $select_category = mysqli_query($conn, "SELECT * FROM `category` ") or die('query failed');
                    $number_of_category = mysqli_num_rows($select_category);
                    ?>
                    <h3><?php echo $number_of_category; ?></h3>
                    <p>Total Category</p>
                </div>

                <div class="box">
                    <?php
                    $select_menu = mysqli_query($conn, "SELECT * FROM `menu`") or die('query failed');
                    $number_of_menu = mysqli_num_rows($select_menu);
                    ?>
                    <h3><?php echo $number_of_menu; ?></h3>
                    <p>menu Added</p>
                </div>





                <!-- <div class="box">
                <?php
                $select_messages = mysqli_query($conn, "SELECT * FROM `res`") or die('query failed ');
                $number_of_messages = mysqli_num_rows($select_messages);
                ?>
                   <h3><?php echo $number_of_messages; ?></h3>
                   <p>New Reservation</p>
                </div> -->

                <div class="box">
                    <?php
                    $select_feedback = mysqli_query($conn, "SELECT * FROM `feedback`") or die('query failed');
                    $number_of_feedback = mysqli_num_rows($select_feedback);
                    ?>
                    <h3><?php echo $number_of_feedback; ?></h3>
                    <p>New Feedback</p>
                </div>

            </div>

        </section>

        <!-- admin dashboard section ends -->
        <!-- custom admin js file link  -->
        <script src="js/admin_script.js"></script>

    </body>
</html>





















</body>
</html>