<?php
include 'config.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM customer WHERE customer_id='$id'");
header("Location: pelanggan_table.php");
?>
