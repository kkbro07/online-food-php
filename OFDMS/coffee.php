<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coffee</title>
    <link rel="stylesheet" href="menuall.css">
</head>
<body>
<div class="box-container">

<?php  
include 'connect.php';
   $select_products = mysqli_query($conn, "SELECT * FROM `menu` where  category='coffee' ") or die('query failed');
   if(mysqli_num_rows($select_products) > 0){
      while($fetch_products = mysqli_fetch_assoc($select_products)){
?>
<form action="" method="post" class="box">
<img class="image" src="addphoto/<?php echo $fetch_products['image']; ?>" alt="" style="width: -webkit-fill-available;">
<div class="name"><?php echo $fetch_products['name']; ?></div>
<button type="submit" name="ordernow" class="btn" onclick="window.location.href = 'header.php'; openPopuplogin();">Order Now</button>

</form>
<?php
   }
}else{
   echo '<p class="empty">no products added yet!</p>';
}
if (isset($_POST['ordernow'])) {
  
    header('Location: index.php');
}
?>
</div>
</body>
</html>