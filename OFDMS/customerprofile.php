<?php
include 'connect.php';
session_start();
// Check if the user is not logged in, then redirect to header.php
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit(); // Ensure script execution stops after redirection
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>customer panel</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="customerprofile.css">
    </head>
    <body>

        <nav class="navbar navbar-inverse visible-xs">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <a class="navbar-brand" href="#">Logo</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Dashboard</a></li>
                        <li><a href="cus_data_view.php">customer details</a></li>
                        <li><a href="#">order</a></li>
                        <li><a href="#">stock</a></li>
                        <li><a href="cus_edit_profile.php">edit profile</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <ul class="nav nav-pills nav-stacked" id="dash-details">
                <li class="active"><a href="customer_panel.php">Dashboard</a></li>
                <li><a href="#">update details</a></li>
                <li><a href="customer-dataview.php">update details </a></li>
                <li><a href="changepassword.php">change password</a></li>
                <li><a href="home.php">Exit</a></li>
            </ul>
        </div>
    </body>
</html>
