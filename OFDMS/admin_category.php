<?php
include("connect.php");
session_start();
// $admin_id = $_SESSION['admin_id'];
// if(!isset($admin_id)){
//    header('location:login.php');
// };
$qry = "SELECT category FROM category";
$result = mysqli_query($conn, $qry);

if (isset($_POST['add_category'])) {
    // Establish a database connection first



    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $status = $_POST['status'];

    // Check if the category name already exists
    $check_category_query = "SELECT category FROM category WHERE category = '$category'";
    $result = mysqli_query($conn, $check_category_query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $message = 'Category name already exists';
        } else {
            $add_category_query = "INSERT INTO category (category, status) VALUES ('$category', '$status')";
            if (mysqli_query($conn, $add_category_query)) {
                $message = 'Category added successfully';
            } else {
                $message = 'Error adding category: ' . mysqli_error($conn);
            }
        }
    } else {
        $message = 'Error checking category: ' . mysqli_error($conn);
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM category WHERE id = '$delete_id'") or die('query failed');
    header('location:admin_category.php');
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CATEGORY</title>
        <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

        <!-- font awesome cdn link  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- custom admin css file link  -->
        <link rel="stylesheet" href="css/admin_style.css">
    </head>
    <body>
        <?php include("admin_header.php");
        ?>
        <section class="add-products">

            <h1 class="title">ADD CATEGORY</h1>

            <form action="" method="post" enctype="multipart/form-data">

 <!-- <input type="text" name="category" class="box" placeholder="select category" required> -->



                <input type="text" name="category" class="box" placeholder="enter category name" required>
                <input type="hidden" value="1" min="0" name="status" class="box"  required>

                <input type="submit" value="add category" name="add_category" class="btn">

            </form>

        </section>

        <!-- product CRUD section ends -->
        <div class="box2">
            <div class="container">
                <table class="table " id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">Category</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $sql = "SELECT * FROM category";
                        $result = mysqli_query($conn, $sql);
                        $sno = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $sno = $sno + 1;
                            ?><tr>
                                <th scope='row'><?php echo $sno; ?></th>
                                <td><?php echo $row['category']; ?></td>
                                <td class='delete' onclick="return confirm('Delete this category?');"> <a href="admin_category.php?delete=<?php echo $row['id']; ?>" ><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                    </table>

            </div>

        </div>
        <!-- show products  -->

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
                integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script>
                                    $(document).ready(function () {
                                        $('#myTable').DataTable();
                                    });
        </script>

        <!-- custom admin js file link  -->
        <script src="js/admin_script.js"></script>
    </body>
</html>






