<?php
include 'config.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM costume WHERE costume_id = '$id'");
header("Location: kostum_table.php");
exit;
?>
