<?php
include 'connect.php';
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Foodie</title>
        <!-- font awesome cdn link  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="style.css">
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
                <a href="#" class="order-button">discover more</a>
            </div>
        </section>
        </main>
        <section class="products" id="item-section">

   <h1 class="title">latest Food</h1>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `menu` ") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="#" method="post" class="box">
      <img class="image" src="addphoto/<?php echo $fetch_products['image']; ?>" alt="" style="width: -webkit-fill-available;">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="order now" name="ordernow" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>
</section>
        <footer>
        <?php include('footer.php');?>
        </footer>
        <script src="js/script.js"></script>
    </body>
</html>
