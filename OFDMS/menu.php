<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <?php
    include("connect.php");
    error_reporting(0);
    session_start();
    ?>
    <head>
        <meta charset="UTF-8">
        <title>Foodie</title>
        <!-- font awesome cdn link  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="menu.css">
    </head>
    <body>
        <header>
            <?php
            include 'header.php';
            ?>
        </header>
        <main>
        <section class="home">
            <div class="content">
                <h4>Heloo foodie.</h4>
                <p>“Food is really and truly the most effective medicine.” – Joel Fuhrman.</p>
                <a href="home.php" class="order-button">discover more</a>
            </div>
        </section>
        </main>
        <section class="products" id="menu-section">
            <div>
            <h1 class="title">pizza</h1>
            <div class="box-container">
            <img src="menuphoto/pizza.webp" alt="Pizza">
            <a href="pizza.php" class="button">view all</a>
            </div>
            </div>
            <div>
            <h1 class="title">coffee</h1>
            <div class="box-container">
            <img src="menuphoto/coffee.webp" alt="Pizza">
            <a class="button" href="coffee.php">View All</a>
            </div>
        </section>
        

        <footer>
        <?php include('footer.php');?>
        </footer>
    </body>
</html>
