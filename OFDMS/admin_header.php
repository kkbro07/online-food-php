<?php
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Food Delivery Admin Panel</title>
        <link rel="stylesheet" href="admin_style.css">
    </head>
    <body>
        <header class="header">
            <div class="flex">
            <a href="adminpanel.php" class="logo">Admin<span>Panel</span></a>
            <nav class="navbar">
                
                    <a href="adminpanel.php">Dashboard</a>
                    <a href="admin_users.php">Users</a>
                    <a href="admin_category.php">Category</a>
                    <a href="admin_menu.php">Menu</a>
                    <a href="admin_orders.php">Orders</a>
                    <a href="admin_feedback.php">Feedback</a>
                    <a href="#">Settings</a>
                </ul>
            </nav>
                <div class="icons">
                <div id="menu-btn" class="fas fa-bars"></div>
                <div id="user-btn" class="fas fa-user"></div>
                </div>
                <div class="account-box">
                <p>username : <span><?php echo $_SESSION['username']; ?></span></p>
                <a href="admin.php" class="delete-btn">logout</a>
                </div>          
        </header>

        <main>
            <!-- Content Goes Here -->
        </main>

    </body>
</html>
