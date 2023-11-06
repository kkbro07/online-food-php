<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>footer</title>
    <link rel="stylesheet" href="footer.css">
</head>
<body>

<footer>

<section class="footer">

<div class="box-container">


   <div class="box">
      <h2>Quick links</h2>
      <a onclick="openPopuplogin(), closePopupsignup()">Login</a><br><br>
      <a onclick="openPopupsignup(), closePopuplogin()">Register</a><br><br>
      <a href="about.php">About Us</a><br><br>
      <a href="contact.php">Feedback</a><br><br>
   </div>

   <div class="box">
      <h2>contact info</h2>
      <a> <i class="fas fa-phone"></i> 895-456-7890 </a>
      <p> <i class="fas fa-phone"></i> 978-657-8574 </p>
      <p> <i class="fas fa-envelope"></i>foodie@gmail.com </p>
      <p> <i class="fas fa-map-marker-alt"></i> surat, india - 395004 </p>
   </div>

   <div class="box">
      <h2>follow us</h2>
      <a href="#"> <i class="fab fa-facebook-f"></i> Facebook </a><br><br>
      <a href="#"> <i class="fab fa-twitter"></i> Twitter </a><br><br>
      <a href="https://www.instagram.com/?hl=en"> <i class="fab fa-instagram"></i> Instagram </a><br><br>
      <a href="#"> <i class="fab fa-linkedin"></i> Linkedin </a><br><br>
   </div>

</div>

<p class="credit"> &copy; copyright  @ <?php echo date('Y'); ?> by <span>FOODIE</span> </p>

</footer>
</section>
<script src="js/script.js"></script>
</body>
</html>