<?php
include 'config.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM checks WHERE check_id = $id");
header("Location: check_table.php");
exit;
?>
