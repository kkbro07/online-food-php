<?php // fetch_data.php
include 'connect.php'; // Include your database connection

// Perform a database query to fetch the data you need
$query = "SELECT month, total_sales FROM your_sales_table";
$result = mysqli_query($conn, $query);

// Create an array to hold the data
$data = array('labels' => array(), 'values' => array());

while ($row = mysqli_fetch_assoc($result)) {
  $data['labels'][] = $row['month'];
  $data['values'][] = $row['total_sales'];
}

// Output the data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>