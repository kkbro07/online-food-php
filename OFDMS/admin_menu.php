<?php
include("connect.php");
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
$qry = "SELECT category FROM category";
$result = mysqli_query($conn, $qry);
if (isset($_POST['add_menu'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'add/' . $image;
    $category = $_POST['category'];

    $select_menu_name = mysqli_query($conn, "SELECT name FROM `menu` WHERE name = '$name'") or die('query failed');

    if (mysqli_num_rows($select_menu_name) > 0) {
        $message[] = 'menu name already added';
    } else {
        $add_menu_query = mysqli_query($conn, "INSERT INTO `menu`(name, price, image,category) VALUES('$name', '$price', '$image','$category')") or die('query failed');

        if ($add_menu_query) {
            if ($image_size > 2000000) {
                $message[] = 'image size is too large';
            } else {
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'menu added successfully!';
            }
        } else {
            $message[] = 'menu could not be added!';
        }
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_image_query = mysqli_query($conn, "SELECT image FROM `menu` WHERE id = '$delete_id'") or die('query failed');
    $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
    unlink('addphoto/' . $fetch_delete_image['image']);
    mysqli_query($conn, "DELETE FROM `menu` WHERE id = '$delete_id'") or die('query failed');
    header('location:admin_menu.php');
}

if (isset($_POST['update_menu'])) {

    $update_p_id = $_POST['update_p_id'];
    $update_name = $_POST['update_name'];
    $update_price = $_POST['update_price'];
    $update_category = $_POST['category'];
    mysqli_query($conn, "UPDATE `menu` SET name = '$update_name', price = '$update_price', category = '$update_category' WHERE id = '$update_p_id'") or die('query failed');

    $update_image = $_FILES['update_image']['name'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_folder = 'addphoto/' . $update_image;
    $update_old_image = $_POST['update_old_image'];

    if (!empty($update_image)) {
        if ($update_image_size > 2000000) {
            $message[] = 'image file size is too large';

        } else {
            mysqli_query($conn, "UPDATE `menu` SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
            move_uploaded_file($update_image_tmp_name, $update_folder);
            unlink('addphoto/' . $update_old_image);
        }
    }

    header('location:admin_menu.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MENU</title>
        <!-- font awesome cdn link  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- custom admin css file link  -->
        <link rel="stylesheet" href="admin_style.css">
    </head>
    <body>
        <?php include("admin_header.php");
        ?>
        <section class="add-products">

            <h1 class="title">add menu</h1>

            <form action="#" method="post" enctype="multipart/form-data">

                <select name="category" class="box">
                <option value="" disabled selected>Select Category</option>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='" . $row['category'] . "'>" . $row['category'] . "</option>";
    }
    ?>
                    </select>

                <input type="text" name="name" class="box" placeholder="enter menu name" required>
                <input type="number" min="0" name="price" class="box" placeholder="enter menu price" required>
                <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
                <input type="submit" value="add menu" name="add_menu" class="btn">
            </form>

        </section>

        <section class="show-products">

            <div class="box-container">

                <?php
                $select_menu = mysqli_query($conn, "SELECT * FROM `menu`") or die('query failed');
                if (mysqli_num_rows($select_menu) > 0) {
                    while ($fetch_menu = mysqli_fetch_assoc($select_menu)) {
                        ?>
                        <div class="box">

                            <img src="addphoto/<?php echo $fetch_menu['image']; ?>" alt="" style="width: -webkit-fill-available;">
                            <div class="name"><?php echo $fetch_menu['name']; ?></div>
                            <div class="price"><?php echo $fetch_menu['price']; ?>/-</div>
                            <a href="admin_menu.php?update=<?php echo $fetch_menu['id']; ?>" class="option-btn">update</a>
                            <a href="admin_menu.php?delete=<?php echo $fetch_menu['id']; ?>" class="delete-btn" onclick="return confirm('delete this menu?');"><i class="fa fa-trash"></i></a>
                        </div>
                        <?php
                    }
                } else {
                    echo '<p class="empty">no menu added yet!</p>';
                }
                ?>
            </div>

        </section>
        </section>

<section class="edit-product-form">

   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `menu` WHERE id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
   <form action="#" method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
      <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
      <img src="addphoto/<?php echo $fetch_update['image']; ?>" alt="">
      <select name="category" class="box">
                <option value="" disabled selected>Select Category</option>
    <?php
    $qry = "SELECT category FROM category";
    $result = mysqli_query($conn, $qry);
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='" . $row['category'] . "'>" . $row['category'] . "</option>";
    }
    ?>
        </select>
      <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="enter menu name">
      <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box" required placeholder="enter menu price">
      <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" value="update" name="update_menu" class="btn">
      <input type="reset" value="cancel" id="close-update" class="option-btn">
   </form>
   <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
   ?>

</section>
        <!-- custom admin js file link  -->
        <script src="js/admin_script.js"></script>
    </body>
</html>




